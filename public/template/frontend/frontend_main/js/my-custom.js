$(document).ready(function () {
    // activeMenu();

    $('.slide-5').on('setPosition', function () {
        $(this).find('.slick-slide').height('auto');
        var slickTrack = $(this).find('.slick-track');
        var slickTrackHeight = $(slickTrack).height();
        $(this)
            .find('.slick-slide')
            .css('height', slickTrackHeight + 'px');
        $(this)
            .find('.slick-slide > div')
            .css('height', slickTrackHeight + 'px');
        $(this)
            .find('.slick-slide .category-wrapper')
            .css('height', slickTrackHeight + 'px');
    });

    $('.breadcrumb-section').css('margin-top', $('.my-header').height() + 'px');
    $('.my-home-slider').css('margin-top', $('.my-header').height() + 'px');

    $(window).resize(function () {
        let height = $('.my-header').height();
        $('.breadcrumb-section').css('margin-top', height + 'px');
        $('.my-home-slider').css('margin-top', height + 'px');
    });

    // show more show less
    if ($('.category-item').length > 10) {
        $('.category-item:gt(9)').hide();
        $('#btn-view-more').show();
    }

    $('#btn-view-more').on('click', function () {
        $('.category-item:gt(9)').toggle();
        $(this).text() === 'Xem thêm' ? $(this).text('Thu gọn') : $(this).text('Xem thêm');
    });

    $('li.my-layout-view > img').click(function () {
        $('li.my-layout-view').removeClass('active');
        $(this).parent().addClass('active');
    });

    $('#sort-form select[name="sort"]').change(function () {
        // console.log(getUrlParam('filter_price'));
        if (getUrlParam('filter_price')) {
            $('#sort-form').append(
                '<input type="hidden" name="filter_price" value="' +
                    getUrlParam('filter_price') +
                    '">'
            );
        }

        if (getUrlParam('search')) {
            $('#sort-form').append(
                '<input type="hidden" name="search" value="' +
                    getUrlParam('search') +
                    '">'
            );
        }

        $('#sort-form').submit();
    });


    setTimeout(function () {
        $('#frontend-message').toggle('slow');
    }, 4000);
});

function activeMenu() {
    // let controller = getUrlParam('controller') == null ? 'index' : getUrlParam('controller');
    // let action = getUrlParam('action') == null ? 'index' : getUrlParam('action');
    let dataActive = controller + '-' + action;
    $(`a[data-active=${dataActive}]`).addClass('my-menu-link active');
}

function getUrlParam(key) {
    let searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(key);
}

function quickViewFunction(id){
	console.log(id);
	var link    = 'index.php?module=frontend&controller=book&action=quickView';
	//Ajax
	$.ajax({
		url		: link,
		type	: 'GET',
		data	: {id:id},
		success	: function(data){	
				/*
				 * <a href="javascript:changeGroupACP('index.php?module=backend&amp;controller=group&amp;action=ajaxGroupACP&amp;id=4&amp;group_acp=0');" id="GroupACP-4" class="btn btn-danger rounded-circle btn-sm">
			            <i class="fas fa-minus"></i>
			        </a>
				 */
				console.log(data);
				
				var dataOject = JSON.parse(data);
//				
				console.log(dataOject);
				var name     = dataOject.name;
				console.log(name);
				var id        		 = dataOject.id;
				var shortDescription = dataOject.shortDescription;
				var picture			 =  dataOject.picture;
				
					
				$('#book-name').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-name').append(name);	// Add text
				
				$('#book-description').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-description').append(shortDescription);	// Add text
				
				$("#quick-view-img").attr("src",picture);
				
				//price
				var saleOff            = dataOject.sale_off;
			    var priceHaveSaleOFF   = dataOject.price;
			    var priceNotSaleOFF    = '';

			    if(saleOff > 0){
			    	
			        priceNotSaleOFF  = dataOject.price+' đ';   
			        priceHaveSaleOFF = (dataOject.price * (100 - saleOff) / 100) + ' đ';
			        
			    }else{
				    var priceHaveSaleOFF   = dataOject.price + ' đ';
				    var priceNotSaleOFF    = '';
			    }
				
				$('#book-price').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-price').append(priceHaveSaleOFF);	// Add text
			    
				$('#price-not-off').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#price-not-off').append(priceNotSaleOFF);	// Add text
			 
				
//				var group_acb = dataOject.group_acb;
//				var url       = dataOject.url;
//				
//				var element = 'a#GroupACP-' + id;
//				var classRemove = 'btn-success';
//				var classAdd 	= 'btn-danger'
//				var iclassRemove	= 'fa-check';
//				var iclassAdd		= 'fa-minus';
//				
//				if(group_acb==1){
//					classRemove 	= 'btn-danger';
//					classAdd 		= 'btn-success';
//					iclassRemove	= 'fa-minus';
//					iclassAdd		= 'fa-check';
//				}
//				
//				$(element).attr('href',"javascript:changeGroupACP('"+url+"')");
//				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
//				$(element).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });
//				//$('#GroupACP-' + id).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });

			}
	})
}
