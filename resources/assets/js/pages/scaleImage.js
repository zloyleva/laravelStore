export class ProductImageScaleModule{
    constructor() {
        console.log('Page: ProductImageScaleModule');

        this.openImageModalHandler();
        this.closeImageModalHandler();
        this.closeImageModalAllHandler();
    }

    openImageModalHandler(){
        $('.product_image').off('click').on('click', e=>{
            e.preventDefault();
            console.log('Click: product_image');

            const src = $(e.target).attr('src');
            console.log(src);
            this.showImageModal(src)
        });
    }

    showImageModal(src){
        $('#scale_image').addClass('show_image_modal');
        $('#scale_image .scale_image_content img').attr('src', src);
    }

    closeImageModalHandler(){
        $('#close_scale_image').off('click').on('click', e=>{
            e.preventDefault();
            console.log('Click: Close');
            this.closeImageMethod();
        });
    }

    closeImageModalAllHandler(){
        $('#scale_image').off('click').on('click', e=>{
            e.preventDefault();
            console.log('Click: Close');
            this.closeImageMethod();
        });
    }

    closeImageMethod(){
        $('#scale_image').removeClass('show_image_modal');
        $('#scale_image .scale_image_content img').attr('src');
    }
}