
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
           
           
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    @foreach ($all_category as $key=>$cate)
                    <h4 class="panel-title"><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a></h4>
                    @endforeach
                    
                </div>
            </div>
            
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Thương Hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($all_brand as $item)
                    <li><a href="{{ URL::to('/thuong-hieu-san-pham/'.$item->brand_id) }}"> <span class="pull-right"></span>{{$item->brand_name  }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
        
        
        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>
	
