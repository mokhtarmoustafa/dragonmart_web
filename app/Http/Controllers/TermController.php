<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\TermEloquent;
use App\Terms;
use Illuminate\Http\Request;


class TermController extends Controller
{
    //

    private $term;

    public function __construct(TermEloquent $termEloquent)
    {
        $this->term = $termEloquent;
    }

    public function term()
    {
        $data = [
            'title' => 'Terms & Conditions',
            'icon' => 'fa fa-legal',
            'term' => Terms::where('type', 'term')->first(),
        ];
        return view(admin_terms_vw() . '.term', $data);
    }

    public function updateTerm(Request $request)
    {
        return $this->term->updateTerm($request->all());
    }

    public function policy()
    {
        $data = [
            'title' => 'Privacy Policy',
            'icon' => 'fa fa-lock',
            'policy' => Terms::where('type', 'policy')->first(),
        ];
        return view(admin_terms_vw() . '.policy', $data);
    }

    public function updatePolicy(Request $request)
    {
        return $this->term->updatePolicy($request->all());
    }
}
