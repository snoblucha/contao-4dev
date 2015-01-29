# 4 Dev - Contao for developers

This module contains helper classes to set up $GLOBAL array used by Contao CMS. 
The arrays are not well documented, especially in languages other then german.
This module will add the autocompletion and documentation under your fingertips
in your Favourite IDE.

## Usage

### DCA - $GLOBALS['tl_dca']

Let's see the example

    $shortTitle = \Dev\Dca\Field::factory('short_title')
    	->exclude(false)
    	->inputType('text')
    	->evaluation(array('submitOnChange' => true))
    	->sql("varchar(64) NOT NULL default ''");

    \Dev\Dca::addField('tl_news', $shortTitle);
    \Dev\Dca::paletteAddAfter('tl_news','title',$shortTitle);


First block defines field. Then we add this field to table `tl_news` and finally modify pallette
to insert newly created field after the `title` in palette. You can see internals.  

### LANG - $GLOBALS['tl_lang']

Example:

    \Dev\Lang::set('tl_news.short_title', array('Short title', 'Short title of the article'))
    \Dev\Lang::get('tl_news.short_title')

In the example you can see, that setting and retrieving value is done in a path notation. The example 
will set/get the value of `$GLOBALS['tl_lang']['tl_news']['short_title']`.

### Hook - $GLOBALS['tl_hook']

    \Dev\Hook::define('before_news_update');
    ....
    
    if(\Dev\Hook::notEmpty('before_news_update')){
        foreach(\Dev\Hook::callbacks('before_news_update') as $callback){
            call_user_func($callback, $arguments);
        }
    }
    
    
