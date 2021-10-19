# Carlisle Student Properties

Here you'll find the source code for [www.carlislestudentproperties.co.uk](https://www.carlislestudentproperties.co.uk), a website I created and maintain.

### Purpose

1. To advertise a family member's business.
2. To showcase my web development skills.

### Key Features

* __Code__ - This is a static website written in HTML, [Bootstrap](https://github.com/twbs/bootstrap), [SASS](https://sass-lang.com)/CSS, JavaScript and PHP.
* __Responsive__ - As clients are most likely viewing the site using a mobile device, responsiveness is a priority. The layout and elements scale according to the display size.
* __Content__ - The site comprises a home page, several property details pages, and an about page. Photos are contained within card and carousel Bootstrap components. Navigation is achieved using a Navbar Bootstrap component.
* __Form handling__ - Clients can complete a form to arrange a viewing. The form data is handled by a PHP script that sends the relevant info by email to the business owner so that a viewing can be arranged.
* __Security__ - Form data is validated to prevent XSS hacking.
* __SEO friendly__ - Optimised by design for search engine compatibility, this website and the associated business entity appear in [search results](https://www.google.com/search?q=carlisle+student+properties).
* __Deployment__ - The free [DeployHQ](https://www.deployhq.com/) package is used to automatically deploy from GitHub and upload to the web server whenever I push commits to this repository.
* __DRY__ - The "**D**on't **R**epeat **Y**ourself" programming principle is applied using the [includeHTML](https://www.w3schools.com/howto/howto_html_include.asp) script from W3Schools.