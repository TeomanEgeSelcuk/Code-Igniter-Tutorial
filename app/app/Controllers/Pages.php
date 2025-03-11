<?php

namespace App\Controllers;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view(string $page = 'home')
    {
        // If the requested page doesn’t exist, a “404 Page not found” error is shown.
        // The first line in this method checks whether the page actually exists. PHP’s native is_file() function is used to check whether the file is where it’s expected to be.
        // The PageNotFoundException is a CodeIgniter exception that causes the 404 Page Not Found error page to show.
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        // In the header template, the $title variable was used to customize the page title.
        // The value of title is defined in this method, but instead of assigning the value to a variable, it is assigned to the title element in the $data array.
        $data['title'] = ucfirst($page); // Capitalize the first letter

        // URL
        // localhost:8080/      the CodeIgniter “welcome” page. the results from the index() method in the Home controller.
        // localhost:8080/pages  the results from the index() method inside our Pages controller, which is to display the CodeIgniter “welcome” page.
        // localhost:8080/home   the “home” page that you made above, because we explicitly asked for it. the results from the view() method inside our Pages controller.
        // localhost:8080/about  the “about” page that you made above, because we explicitly asked for it.
        // localhost:8080/shop   a “404 - File Not Found” error page, because there is no app/Views/pages/shop.php.
        
        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}