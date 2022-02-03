<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/page_not_found';
$route['certificate/(:any)']        = "addons/certificate/generate_certificate/$1";
// $route['(:any)'] = "home/$1;

//course bundles
$route['course_bundles/(:any)']                                = "addons/course_bundles/index/$1";
$route['course_bundles']                                    = "addons/course_bundles";
$route['course_bundles/search/(:any)']                        = "addons/course_bundles/search/$1";
$route['course_bundles/search/(:any)/(:any)']                = "addons/course_bundles/search/$1/$1";
$route['bundle_details/(:any)/(:any)']                      = "addons/course_bundles/bundle_details/$1";
$route['bundle_details/(:any)']                              = "addons/course_bundles/bundle_details/$1/$1";
$route['course_bundles/buy/(:any)']                          = "addons/course_bundles/buy/$1";
$route['home/my_bundles']                                      = "addons/course_bundles/my_bundles";
$route['home/bundle_invoice/(:any)']                          = "addons/course_bundles/invoice/$1";
//end course bundles



$route['linkedin-mastery-course'] = "home/course/linkedin-mastery-course/2";
$route['photoshop-mastery-course'] = "home/course/photoshop-mastery-course/5";
$route['youtube-mastery-course'] = "home/course/youtube-mastery-course/3";
$route['freelancer-mastery-course'] = "home/course/freelancer-mastery-course/3";
$route['upwork-mastery-course'] = "home/course/upwork-mastery-course/4";

$route['about-us'] = "home/about_us";
$route['privacy-policy'] = "home/privacy_policy";
$route['terms-and-condition'] = "home/terms_and_condition";
$route['refund-policy'] = "home/refund_policy";
$route['faq'] = "home/faq";
$route['login'] = "home/login";
$route['shopping-cart'] = "home/shopping_cart";
$route['my-courses'] = "home/my_courses";
$route['purchase-history'] = "home/purchase_history";
$route['user-profile'] = "home/profile/user_profile";
$route['login'] = "home/login";
$route['payment'] = "home/payment";


// $route['my-courses'] = "home/logmy_coursesin";


$route['translate_uri_dashes'] = FALSE;
