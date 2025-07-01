<?php

namespace App\Http\Controllers;

use App\Models\CompanyAbout;
use App\Models\CompanyStatistic;
use App\Models\HeroSection;
use App\Models\OurPrinciple;
use App\Models\OurTeam;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $hero_section = HeroSection::orderByDesc('id')->take(1)->get();
        $statistics = CompanyStatistic::take(4)->get();
        $principles = OurPrinciple::take(4)->get();
        $products = Product::take(4)->get();
        $testimonials = Testimonial::take(5)->get();
        $teams = OurTeam::take(7)->get();
        return view('front.index', compact('hero_section', 'statistics', 'principles', 'products', 'testimonials', 'teams'));
    }

    public function team()
    {
        $teams = OurTeam::take(7)->get();
        $statistics = CompanyStatistic::take(4)->get();
        return view('front.team', compact('teams', 'statistics'));
    }

    public function about()
    {
        $statistics = CompanyStatistic::take(4)->get();
        $principles = OurPrinciple::take(4)->get();
        $abouts = CompanyAbout::take(2)->get();
        return view('front.about', compact('statistics', 'principles', 'abouts'));
    }
}