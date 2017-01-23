<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Theme;
use App\Code;
use App\Link;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('theme')->paginate(10);

        $themes = Theme::all();

        $codes = Code::all();

        $links = Link::all();

        return view('home', compact('pages', 'themes', 'links', 'codes'));
    }

    public function addpages(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|unique:pages'
        ]);

        (new Page)->add($request);

        return redirect()->back()->with('status', 'Pages have been created!');
    }

    public function editpages(Page $page)
    {
        $pages = Page::with('theme')->paginate(5);

        $themes = Theme::all();

        $codes = Code::all();

        $links = Link::all();

        return view('page_edit', compact('page', 'pages', 'themes', 'links', 'codes'));
    }

    public function updatepages(Request $request, Page $page)
    {
        $this->validate($request, [
            'slug' => [
                'required',
                Rule::unique('links')->ignore($page->id),
            ]
        ]);

        $page->update($request->input());

        return redirect()->back()->with('status', 'Pages have been updated!');
    }

    public function themes()
    {
        $themes  = Theme::paginate(10);

        return view('themes', compact('themes'));
    }

    public function addthemes(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:themes',
            'html' => 'required'
        ]);

        (new Theme)->create($request->input());

        return redirect()->back()->with('status', 'Theme have been created!');
    }

    public function editthemes(Theme $theme)
    {
        $themes  = Theme::paginate(10);

        return view('theme_edit', compact('themes', 'theme'));
    }

    public function updatethemes(Request $request, Theme $theme)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('themes')->ignore($theme->id),
            ],
            'html' => [
                'required'
            ]
        ]);

        $theme->update($request->input());

        return redirect()->back()->with('status', 'Theme have been updated!');
    }

    public function links()
    {
        $links  = Link::paginate(10);

        return view('links', compact('links'));
    }

    public function addlinks(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|unique:links',
            'link' => 'required',
            'keywords' => 'required'
        ]);

        (new Link)->create($request->input());

        return redirect()->back()->with('status', 'Link have been created!');
    }

    public function editlinks(Link $link)
    {
        $links  = Link::paginate(10);

        return view('link_edit', compact('links', 'link'));
    }

    public function updatelinks(Request $request, Link $link)
    {
        $this->validate($request, [
            'slug' => [
                'required',
                Rule::unique('links')->ignore($link->id),
            ],
            'link' => [
                'required'
            ],
            'keywords' => [
                'required'
            ]
        ]);

        $link->update($request->input());

        return redirect()->back()->with('status', 'Link have been updated!');
    }

    public function slug($slug)
    {
        $page = Page::whereSlug(strtolower($slug))->firstorFail();
    
        $code = strtoupper($page->slug);

        $keywords = explode(PHP_EOL, $page->link->keywords);


        $keyword = str_replace("%keyword%", str_replace(" ", "+", $keywords[$page->link->counter]), $page->link->link);

        $link = str_replace("%slug%", strtoupper($page->slug), $keyword);

        if ($page->link->counter < count($keywords) - 1) {
            $page->link->counter++;
        } else {
            $page->link->counter = 0;
        }

        $page->link->save();

        // $html = $page->theme->html;

        // $code and $link passed to html

        // return view('show', compact('html', 'link', 'code'));

        return eval("?>" . $page->theme->html . "<?");
    }
}
