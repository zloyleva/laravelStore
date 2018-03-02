export class SliderModule{
    constructor() {
        console.log('Page: SliderModule');

        this.init();
    }

    init(){
        $('.main_slider').flexslider({
            animation: "slide"
        });
    }

}