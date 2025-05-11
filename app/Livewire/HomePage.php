<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Category;
use App\Models\County;
use App\Models\Event;
use App\Models\News;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

class HomePage extends Component
{
    #[Title('Visit Denizli - Denizli\'yi Ziyaret Edin - Denizli Turizminin En İyilerini Keşfedin, Turkey')]
    public $countyQuery = '';
    public $counties = [];
    public $showDropdown = false;

    public function render()
    {
        $setting = getSetting();
        $categories = Category::where('status', 1)->get();
        $cities = County::where('status', 1)
            ->inRandomOrder()
            ->take(6)
            ->get();
        $blogs = Blog::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $event = Event::where('status', 1)
            ->whereRaw("STR_TO_DATE(start_date, '%d.%m.%Y %H:%i') > NOW()")
            ->orderBy('created_at', 'desc')
            ->first();

        $news = News::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // SEO Metadata
        $seoTitle = 'Denizli\'yi Ziyaret Edin - Denizli Turizminin En İyilerini Keşfedin';
        $seoDescription = 'Denizli\'nin en iyi turistik yerlerini, konaklama yerlerini ve yerel deneyimlerini keşfedin. Pamukkale ve Denizli\'nin diğer önemli noktalarına mükemmel seyahatinizi planlayın.';
        $seoKeywords = 'Denizli turizmi, Pamukkale, Denizli gezi rehberi, Denizli\'de gezilecek yerler, Denizli otelleri';
        $seoImage = asset($setting->logo ?? 'front/assets/images/denizli-social-preview.jpg');

        // Structured Data
        $structuredData = [
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => "Visit Denizli",
            "url" => url('/'),
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => url('/search') . "?q={search_term_string}",
                "query-input" => "required name=search_term_string"
            ]
        ];

        if ($event) {
            $structuredData['@graph'][] = [
                "@type" => "Event",
                "name" => app()->getLocale() == 'tr' ? $event->name : $event->name_en,
                "startDate" => Carbon::createFromFormat('d.m.Y H:i', $event->start_date)->format('Y-m-d\TH:i'),
                "endDate" => Carbon::createFromFormat('d.m.Y H:i', $event->end_date)->format('Y-m-d\TH:i'),
                "eventAttendanceMode" => "https://schema.org/OfflineEventAttendanceMode",
                "eventStatus" => "https://schema.org/EventScheduled",
                "location" => [
                    "@type" => "Place",
                    "name" => $event->county->name,
                    "address" => [
                        "@type" => "PostalAddress",
                        "addressLocality" => $event->county->name,
                        "addressRegion" => "Denizli",
                        "addressCountry" => "TR"
                    ]
                ],
                "image" => asset($event->image),
                "description" => app()->getLocale() == 'tr' ? $event->description : $event->description_en,
                "offers" => [
                    "@type" => "Offer",
                    "url" => route('news.detail', ['categorySlug' => 'yaklasan-etkinlikler', 'placeSlug' => $event->slug]),
                    "availability" => "https://schema.org/InStock"
                ]
            ];
        }

        // Local Business Data
        $localBusinessData = [
            "@context" => "https://schema.org",
            "@type" => "LocalBusiness",
            "name" => "Visit Denizli",
            "image" => asset('front/assets/images/logo.png'),
            "@id" => url('/'),
            "url" => url('/'),
            "telephone" => "+90 258 123 4567",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "Your Street Address",
                "addressLocality" => "Denizli",
                "postalCode" => "20000",
                "addressCountry" => "TR"
            ],
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => "37.7833",
                "longitude" => "29.0833"
            ]
        ];

        view()->share([
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'seoKeywords' => $seoKeywords,
            'seoImage' => $seoImage,
            'structuredData' => $structuredData,
            'localBusinessData' => $localBusinessData
        ]);

        return view('livewire.home-page', [
            'setting' => $setting,
            'categories' => $categories,
            'cities' => $cities,
            'blogs' => $blogs,
            'event' => $event,
            'news' => $news,
        ]);
    }

    public function searchCounties()
    {
        $this->showDropdown = true;
        $this->counties = County::where('name', 'like', '%' . $this->countyQuery . '%')
            ->limit(10)
            ->get();
    }

    public function selectCounty($countyName)
    {
        $this->countyQuery = $countyName;
        $this->showDropdown = false;
    }

    protected $listeners = [
        'showDropdown' => 'showDropdown',
        'hideDropdown' => 'hideDropdown',
    ];

    public function showDropdown()
    {
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }
}
