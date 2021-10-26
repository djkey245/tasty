<?php


namespace App\Http\View\Composers;


use Illuminate\View\View;

class LangSelectComposer
{
    /**
     * @var string[]
     */
    private $langs;
    /**
     * @var string[]
     */
    private $flags;
    /**
     * @var string
     */
    private $selectedLang;

    public function __construct()
    {
        $this->langs = array_keys(config('laravellocalization.supportedLocales'));
        $this->flags = [
            'en' => 'flag-icon-us',
            'ru' => 'flag-icon-ru',
            'pl' => 'flag-icon-pl',
            'es' => 'flag-icon-es',
            'de' => 'flag-icon-de'
        ];
        $this->selectedLang = app()->getLocale();
    }

    public function compose(View $view)
    {
        $view->with('langs', $this->langs);
        $view->with('flags', $this->flags);
        $view->with('selectedLang', $this->selectedLang);
    }
}
