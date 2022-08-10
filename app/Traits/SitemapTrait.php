<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sitemap;
use Validator;
use App\Models\Categories;

trait SitemapTrait{

    public function SitemapCUD(Request $request=NULL,$data,string $type='shop',$source='vendor',string $action='add')
    {
        $status_arr = array('add'=>1,'update'=>2,'delete'=>3);
        //Vendor Status Sitemap    
        $hostwithHttp = request()->getSchemeAndHttpHost();
        if($action =='add')
        {
                $site_vendor_status = $data->status=='ACTIVE'?1:3;
                $sitemap_up = Sitemap::updateOrCreate(
                    ['vendor_id' => $data->id],
                    ['category_name' => $data->business_name, 
                    'type' => $type, 
                    'slug' => $data->slug, 
                    'url' => $hostwithHttp."/".$type."/".$data->slug, 
                    'filename' => 'sitemap_shop_vendor-1.xml', 
                    'level' => $source, 
                    'status' => $site_vendor_status]
                );
        }
        elseif($action=='update')
        {

            $sitemap = Sitemap::where('vendor_id',$data->id)->first();
            if($sitemap)
            {
                if($data->status=='ACTIVE' && $sitemap->status==0)
                {
                    $site_vendor_old_url = $hostwithHttp."/".$type."/".$data->slug;
                    $request_slug = str_slug($request['business_name'],'-');
                    $site_vendor_status = ($data->status=='ACTIVE'?2:3);
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['vendor_id' => $data->id],
                        ['category_name' => $request->business_name, 
                        'type' => $type, 
                        'slug' => $data->slug, 
                        'url' => $hostwithHttp."/".$type."/".$request_slug, 
                        'filename' => 'sitemap_shop_vendor-1.xml', 
                        'level' => $source, 
                        'old_url' => $site_vendor_old_url, 
                        'status' => $site_vendor_status]
                    );
                }
                elseif($sitemap->status==1 || $sitemap->status==2)
                {
                    $request_slug = str_slug($request['business_name'],'-');
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['vendor_id' => $data->id],
                        ['category_name' => $request->business_name, 
                        'type' => $type, 
                        'slug' => $data->slug, 
                        'url' => $hostwithHttp."/".$type."/".$request_slug, 
                        'filename' => 'sitemap_shop_vendor-1.xml', 
                        'level' => $source, 
                        // 'old_url' => $site_vendor_old_url, 
                        'status' => $sitemap->status]
                    );
                }
            }
        }        
        else
        {
            $sitemap_up = Sitemap::updateOrCreate(
                ['vendor_id' => $data->id],
                ['status' =>3]
            );
        }
        //Sitemap 
    }

    public function SitemapProduct(Request $request=NULL,$data,string $type='product',$source='product',string $action='add',$vendor_id='')
    {
        // $status_arr = array('add'=>1,'update'=>2,'delete'=>3);
        $status_arr = array('add'=>1,'update'=>2,'slug_update'=>2,'delete'=>3);
        // $site_vendor_status = $data->vendor_status=='ACTIVE'?1:3;
        //Vendor Status Sitemap    
        if(isset($request))
        {
          $hostwithHttp = request()->getSchemeAndHttpHost();
        }
        if($action =='add')
        {
            if($data->vendor_status =='ACTIVE' && $data->admin_status =='APPROVED')
            {
                $sitemap = Sitemap::where('product_id',$data->id)->first();
                if($sitemap)
                {
                    if($sitemap->status == 3)
                    {
                        $sitemap_up = Sitemap::updateOrCreate(
                            ['product_id' => $data->id],
                            ['vendor_id' => $data->vendor_id,
                            'category_id' => $data->category_id, 
                            'parent_id' => $data->parent_id,
                            'type' => $type, 
                            'slug' =>$data->slug,
                            // 'url' =>$hostwithHttp."/".$type."/".$data->slug.'-'.$data->id,
                            'url' =>$hostwithHttp."/".$type."/".$data->slug,
                            'old_url' =>$sitemap->url,
                            'category_name' =>$data->title,
                            'filename' => 'sitemap_product-1.xml', 
                            'level' => $source, 
                            'status' => 2]
                        );
                    }
                }else{
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['product_id' => $data->id],
                        ['vendor_id' => $data->vendor_id,
                        'category_id' => $data->category_id, 
                        'parent_id' => $data->parent_id,
                        'type' => $type, 
                        'slug' =>$data->slug,
                        // 'url' =>$hostwithHttp."/".$type."/".$data->slug.'-'.$data->id,
                        'url' =>$hostwithHttp."/".$type."/".$data->slug,
                        'category_name' =>$data->title,
                        'filename' => 'sitemap_product-1.xml', 
                        'level' => $source, 
                        'status' => $status_arr['add']]
                    );
                } 
            }
            elseif($data->vendor_status =='ACTIVE' && $data->admin_status !='APPROVED')
            {
                $sitemap = Sitemap::where('product_id',$data->id)->first();
                if($sitemap){
                    $sitemap->status = 3;
                    $sitemap->save();
                }
                // dd($data);
            }
        }
        elseif($action=='update')
        {
            $sitemap = Sitemap::where('product_id',$data->id)->first();
            if($sitemap)
            {
                if($sitemap->status==0){
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['product_id' => $data->id],
                        ['vendor_id' => $data->vendor_id,
                        'category_id' => $request['category_id'], 
                        'parent_id' => $request['parent_id'],
                        'type' => $type, 
                        'slug' =>($data->title == $request['title'])? $data->slug : str_slug($request['title'],'-').'-'.$data->id,
                        //19nov21 'url' =>$hostwithHttp."/".$type."/".(($data->title == $request['title'])? $data->slug : str_slug($request['title'],'-').'-'.$data->id),
                        'url' =>$hostwithHttp.'/'.$type.'/'.$data->slug,
                        'old_url' =>$hostwithHttp.'/'.$type.'/'.$data->slug,
                        'category_name' =>$request['title'],
                        'filename' => $sitemap->filename, 
                        'level' => $source, 
                        'status' => $status_arr[$action]]
                    );
        
                }elseif($sitemap->status==1 || $sitemap->status==2){
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['product_id' => $data->id],
                        ['vendor_id' => $data->vendor_id,
                        'category_id' => $request['category_id'], 
                        'parent_id' => $request['parent_id'],
                        'type' => $type, 
                        'slug' =>($data->title == $request['title'])? $data->slug : str_slug($request['title'],'-').'-'.$data->id,
                        //19nov21 'url' =>$hostwithHttp."/".$type."/".(($data->title == $request['title'])? $data->slug : str_slug($request['title'],'-').'-'.$data->id),
                        'url' =>$hostwithHttp.'/'.$type.'/'.$data->slug,
                        // 'old_url' =>$hostwithHttp.'/'.$type.'/'.$data->slug,
                        'category_name' =>$request['title'],
                        'filename' => $sitemap->filename, 
                        'level' => $source, 
                        'status' =>$sitemap->status]
                    );   
                }elseif($sitemap->status==3){
                    $sitemap_up = Sitemap::updateOrCreate(
                        ['product_id' => $data->id],
                        ['status' =>3]
                    );
                }
                
            }
        }        
        elseif($action == 'slug_update')
        {
            // dump($data);
            $sitemap = Sitemap::where('product_id',$data->id)->first();
            if($sitemap->status==0){
                $sitemap_up = Sitemap::updateOrCreate(
                    ['product_id' => $data->id],
                    ['vendor_id' => $data->vendor_id,
                    'category_id' => $data->category_id, 
                    'parent_id' => $data->parent_id,
                    'type' => $type, 
                    'slug' =>$data->slug,
                    'url' =>$hostwithHttp."/".$type."/".$data->slug,
                    'old_url' =>$hostwithHttp.'/'.$type.'/'.$request->old_slug,
                    'category_name' =>$data->title,
                    'filename' => $sitemap->filename, 
                    'level' => $source, 
                    'status' => $status_arr[$action]]
                );
    
            }            
            elseif($sitemap->status==1 || $sitemap->status==2)
            {
                // dd('im in slug update');
                $sitemap_up = Sitemap::updateOrCreate(
                    ['product_id' => $data->id],
                    ['vendor_id' => $data->vendor_id,
                    'category_id' => $data->category_id, 
                    'parent_id' => $data->parent_id,
                    'type' => $type, 
                    'slug' =>$data->slug,
                    'url' =>$hostwithHttp."/".$type."/".$data->slug,
                    // 'old_url' =>$hostwithHttp.'/'.$type.'/'.$data->slug,
                    'category_name' =>$data->title,
                    'filename' => $sitemap->filename, 
                    'level' => $source, 
                    'status' =>$sitemap->status]
                );   
            }   
        }
        elseif($action == 'delete')
        {
            $sitemap_up = Sitemap::updateOrCreate(
                ['product_id' => $data->id],
                ['status' =>3]
            );
        }        
        // else
        // {
        //     $sitemap_up = Sitemap::updateOrCreate(
        //         ['product_id' => $data->id],
        //         ['status' =>3]
        //     );
        // }
        //Sitemap 
    }

    public function SitemapCategories(Request $request=NULL,$data,string $type='category',$source='category',string $action='add')
    {
        $status_arr = array('add'=>1,'update'=>2,'delete'=>3);

        //Sitemap pre check
        if(isset($request))
        {
            $hostwithHttp = request()->getSchemeAndHttpHost();
            $level='';
            $cat_prt_child = \App\Models\Categories::where('id',$request->parent_id)->get();
            if($request->parent_id!=0)
            {
                foreach($cat_prt_child as $prow)
                {
                    if($prow->parent_id !=0)
                    {
                        if($prow->parentCategory->slug)
                        {
                                $cat_url =  $prow->parentCategory->slug."/".$prow->slug."/".($request->slug!=$data->slug?$request->slug:$data->slug);
                                $old_cat_url =  $prow->parentCategory->slug."/".$prow->slug."/".$data->slug;
                        }else{
                                $cat_url =  $prow->slug."/".($request->slug!=$data->slug?$request->slug:$data->slug);
                                $old_cat_url =  $prow->slug."/".$data->slug;
                        }
                    }
                    else{
                            $cat_url = $prow->slug."/".$request->slug;
                            $old_cat_url = $prow->slug."/".$data->slug;
                    }
                }
            }
            else{
                $cat_url = $request->slug;
                $old_cat_url = $data->slug;
            }

            if($request->parent_id == 0)
            {
                $level ='1';
                $level_file = 'main';
            }
            else{
                if($cat_prt_child[0]->parent_id == 0)
                {
                    $level ='2';
                    $level_file = 'parent';
                }
                else
                {
                    $level='3';
                    $level_file = 'child';
                }            
            }
        }
        //Sitemap pre check
        if($action =='add')
        {        
            //ADD Sitemap
            $model = new Sitemap();
            $model->category_id = $data->id;
            $model->parent_id = $request->parent_id;
            $model->category_name = $request->title;
            $model->type = 'category';
            $model->slug = $request->slug;
            $model->url = $hostwithHttp."/".$type."/".$cat_url;
            $model->filename= 'sitemap_'.$level_file.'_category-1.xml';
            // $model->level = ($parent_id == 0 ? 1 :2);
            $model->level = $level;
            $model->status = $status_arr[$action];
            $model->save();
        }
        elseif($action=='update')
        {
            //UPDATE Sitemap
            $sitemap_up = Sitemap::where('category_id', '=', $data->id)->first();
            if($sitemap_up)
            {
                if($sitemap_up->status==0)
                {
                    $sitemap_up->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
                    $sitemap_up->category_name = $request->title;
                    $sitemap_up->type = $type;
                    $sitemap_up->level = $level;
                    $sitemap_up->slug = $request->slug;
                    $sitemap_up->url = $hostwithHttp."/".$type."/".$cat_url;
                    $sitemap_up->old_url = ($request->slug == $data->slug)? NULL: $hostwithHttp."/".$type."/".$old_cat_url;
                    $sitemap_up->status= ($request->slug != $data->slug)? 2: $sitemap_up->status;
                    $sitemap_up->filename= 'sitemap_'.$level_file.'_category-1.xml';
                    $sitemap_up->save();
                }
                elseif($sitemap_up->status==1 || $sitemap_up->status==2)
                {
                    $sitemap_up->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
                    $sitemap_up->category_name = $request->title;
                    $sitemap_up->type = $type;
                    $sitemap_up->level = $level;
                    $sitemap_up->slug = $request->slug;
                    $sitemap_up->url = $hostwithHttp."/".$type."/".$cat_url;
                    // $sitemap_up->old_url = ($request->slug == $data->slug)? NULL: $hostwithHttp."/".$type."/".$data->slug;
                    // $sitemap_up->status= $sitemap_up->status;
                    $sitemap_up->filename= 'sitemap_'.$level_file.'_category-1.xml';
                    $sitemap_up->save();
                }
            }
        }
        elseif($action=='delete'){
            //Sitemap
            $sitemap_up = Sitemap::where('category_id', '=', $data->id)->firstOrFail();
            if($sitemap_up){
                $sitemap_up->status = 3;
                $sitemap_up->save();
            }
        }
    }

}