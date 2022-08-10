<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Sitemap;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SitemapController extends Controller
{

    public function unified()
    {
        $filenames = [];
        $filenames = array_merge($filenames, $this->staticUrls());
        $this->createsitemap($filenames);

        $filenames = array_merge($filenames, $this->mainCategory());
        $this->createsitemap($filenames);

        $filenames = array_merge($filenames, $this->parentCategory());
        $this->createsitemap($filenames);

        $filenames = array_merge($filenames, $this->childCategory());
        $this->createsitemap($filenames);

        $filenames = array_merge($filenames, $this->product());
        $this->createsitemap($filenames);

        $filenames = array_merge($filenames, $this->shopVendor());
        $this->createsitemap($filenames);
        
        File::copy(base_path('public/sitemap/sitemap.xml'), base_path('public/sitemap.xml'));
        File::delete(base_path('public/sitemap/sitemap.xml'));
    }

    public function createsitemap($filenames)
    {
        $data = '';
        $data .= '<?xml version="1.0" encoding="UTF-8"?>';
        $data .= '<sitemapindex ';
        $data .= ' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        foreach ($filenames as $filename) {
            $node = '<sitemap>';
            $node .= '<loc>' . config('app.url')  . $filename . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '</sitemap>';

            $data .= $node;
        }
        // $data .= '<sitemap>';
        // $data .= '<loc>' . config('app.url') . 'blog/sitemap_index.xml </loc>';
        // $data .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
        // $data .= '</sitemap>';

        $data .= '</sitemapindex>';
        File::put(base_path('public/sitemap/sitemap.xml'), $data);
    }

    public function staticUrls()
    {
        $filenames = [];

        $urls = Sitemap::where('type','static')->select(['url','id'])->distinct()->get();

        $data = '';
        $data .= '<?xml version="1.0" encoding="UTF-8"?>';
        $data .= '<urlset ';
        $data .= ' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($urls as $url) {

            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $url->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;
            

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_static-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_static-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$url->id)->update(['filename'=> 'sitemap_static-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_static-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_static-' . $fileCounter . '.xml';

        return $filenames;
    }

    public function mainCategory()
    {
        $filenames = [];

        $categories = Sitemap::where('type','category')->where('level','1')->select(['url','id'])->distinct()->get();

        $data = '';
        $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($categories as $category) {
            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $category->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_main_category-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_main_category-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$category->id)->update(['filename'=> 'sitemap_main_category-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_main_category-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_main_category-' . $fileCounter . '.xml';

        return $filenames;
    }

    public function parentCategory()
    {
        $filenames = [];

        $parent_categories = Sitemap::where('type','category')->where('level','2')->select(['url','id'])->distinct()->get();

        // dd($parent_categories->first());
        $data = '';
        $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($parent_categories as $parent_category) {

            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $parent_category->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_parent_category-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_parent_category-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$parent_category->id)->update(['filename'=> 'sitemap_parent_category-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_parent_category-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_parent_category-' . $fileCounter . '.xml';

        return $filenames;
    }

    public function childCategory()
    {
        $filenames = [];

        $child_categories = Sitemap::where('type','category')->where('level','3')->select(['url','id'])->distinct()->get();

        
        $data = '';
        $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($child_categories as $child_category) {
            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $child_category->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_child_category-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_child_category-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$child_category->id)->update(['filename'=> 'sitemap_child_category-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_child_category-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_child_category-' . $fileCounter . '.xml';

        return $filenames;
    }

    public function product()
    {
        $filenames = [];

        $products = Sitemap::where('type','product')->select(['url','id'])->distinct()->get();
        
        $data = '';
        $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($products as $product) {
            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $product->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_product-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_product-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$product->id)->update(['filename'=> 'sitemap_product-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_product-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_product-' . $fileCounter . '.xml';

        return $filenames;
    }

    public function shopVendor()
    {
        $filenames = [];

        $shopVendors = Sitemap::where('type','shop')->where('level','vendor')->select(['url','id'])->distinct()->get();
        
        $data = '';
        $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
        $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $fileCounter = 1;
        $counter = 1;
        foreach ($shopVendors as $shopVendor) {
            $node = '<url>';
            $node .= '<loc>' . str_replace('&','-', $shopVendor->url) . '</loc>';
            $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
            $node .= '<priority>0.80</priority>';
            $node .= '</url>';

            $data .= $node;

            if ($counter == 3000) {
                $counter = 1;

                $data .= '</urlset>';
                File::put('sitemap/sitemap_shop_vendor-' . $fileCounter . '.xml', $data);
                $filenames[] = 'sitemap/sitemap_shop_vendor-' . $fileCounter . '.xml';
                $fileCounter++;

                $data = '';
                $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            } else {
                $counter++;
            }

            Sitemap::where('id',$shopVendor->id)->update(['filename'=> 'sitemap_shop_vendor-' . $fileCounter . '.xml']);
        }

        $data .= '</urlset>';
        File::put('sitemap/sitemap_shop_vendor-' . $fileCounter . '.xml', $data);
        $filenames[] = 'sitemap/sitemap_shop_vendor-' . $fileCounter . '.xml';

        return $filenames;
    }

    public static function sitemapUpdate(){

        ////////////////////////// UPDATING URL'S IN SITEMAP 

        $updatedUrls = Sitemap::where('status','2')->whereNotNull('filename')->select(['url','old_url','id','filename'])->orderby('filename')->get();

        
        if(!$updatedUrls->isEmpty()){
            foreach($updatedUrls as $updatedUrl){
                $xml = simplexml_load_file(public_path('sitemap') . '/' . $updatedUrl->filename) or die('Failed to create an object');
                $count = 0;
                foreach ($xml->children() as $books) {
                    if ($books->loc == $updatedUrl->old_url) {
                        $books->loc = $updatedUrl->url;
                        $books->lastmod = Carbon::now()->toW3cString();
                        $xml->asXML(public_path('sitemap') . '/' . $updatedUrl->filename);
                        dump($updatedUrl);
                        Sitemap::where('id',$updatedUrl->id)->update(['status'=> 0, 'old_url'=>'']);
                    }
                    $count++;
                }
            }
        }

        dump('Updated');
    }

    public static function sitemapAdd(){

        ////////////////////////// ADDING URL'S IN SITEMAP 

        $newUrls = Sitemap::where('status','1')->get();
      //  dd($newUrls);
        $getfiles = Storage::disk('sitemap')->allfiles();

        if(!$newUrls->isEmpty()){
            foreach($newUrls as $newUrl){

                $files = array_filter($getfiles, function ($item) use ($newUrl) {
                    return strpos($item, $newUrl->sitemap_name);
                });

                // dd($newUrls);

                $filename = array_last($files);
                $lastfile = (str_replace('sitemap_' . $newUrl->sitemap_name . '-', '', $filename));
                $lastfile = (str_replace('.xml', '', $lastfile));
                
                $lastfile = is_numeric($lastfile) ? $lastfile : 0;

                // dd($lastfile);

                // $linecount = (substr_count(File::get('sitemap/' . $filename), "</url><url>"));
                $linecount = (substr_count(File::get(base_path('public/sitemap/' . $filename)), "</url><url>"));

                dump($linecount);

                $filecontent = Storage::disk('sitemap')->get($filename);

                $node = '<url>';
                $node .= '<loc>' . $newUrl->url . '</loc>';
                $node .= '<lastmod>' . Carbon::now()->toW3cString() . '</lastmod>';
                $node .= '<priority>0.80</priority>';
                $node .= '</url>';

                dump($node);
                //old set 4996
                if ($linecount < 2996) {
                    $filecontent = str_replace('</urlset>', $node . '</urlset>', $filecontent);
                    Storage::disk('sitemap')->put($filename, $filecontent);
                } else {
                    $data = '';
                    $data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
                    $data .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
                    $data .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
                    $data .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
                    $data .= $node;
                    $data .= '</urlset>';
                    //Persmission Required 774 or 644 user required apache/centos
                    $filename = $newUrl->sitemap_name . '-' . ($lastfile + 1) . '.xml';
                    File::put('sitemap/sitemap_'. $filename, $data);
                }

                Sitemap::where('id',$newUrl->id)->update(['status'=> 0, 'filename'=>$filename]);
            }
        }

        dump('Added');
    }

    public static function sitemapDelete(){
        ////////////////////////// DELETING URL'S FROM SITEMAP

        $deltedUrls = Sitemap::where('status','3')->whereNotNull('filename')->select(['url','id','filename'])->orderby('filename')->get();

        if(!$deltedUrls->isEmpty()){
            foreach($deltedUrls as $deltedUrl){
                $xml = simplexml_load_file(public_path('sitemap') . '/' . $deltedUrl->filename) or die('Failed to create an object');
                $count = 0;

                $doc = new \DOMDocument;
                $doc->load(public_path('sitemap') . '/' . $deltedUrl->filename);
                $thedocument = $doc->documentElement;
                $list = $thedocument->getElementsByTagName('url');
                $nodeToRemove = null;
                
                foreach ($list as $domElement){
                    if ($domElement->firstChild != null){
                        if ($domElement->firstChild->nodeValue == $deltedUrl->url) {
                            $nodeToRemove = $domElement; 
                            dump($domElement->firstChild->nodeValue);
                        }
                    }
                }
                
                if ($nodeToRemove != null){
                    $thedocument->removeChild($nodeToRemove);
                    $doc->save(public_path('sitemap') . '/' . $deltedUrl->filename);
                }
                Sitemap::where('id',$deltedUrl->id)->delete();
            }
        }

        dump('Deleted');
    }

}
