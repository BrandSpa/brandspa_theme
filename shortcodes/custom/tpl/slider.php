<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        {% for slide in slides %}
        <div class="swiper-slide">
            <div class="slide-content">
                <div class="row w-100 vh-80">
                    <div class="col-md-6 d-flex align-items-center text-left scene">
                        <h1 class="slide-text" data-depth="0.6">{{slide['slide_content']}}</h1>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end text-right">
                        <ul class="scene">
                            <li data-depth="0.2">
                                <img  src="{{slide['object_img']}}" alt="">
                            </li>
                            <li data-depth="0.6">
                                <img  src="{{slide['model_img']}}" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row w-100 slide-footer">
                    <div class="col-12 vh-20">
                        <div>
                            <div class="arrow bounce">
                                <img src="{{template}}/shortcodes/custom/images/arrow-down.png">
                                <span class="vertical-text">SCROLL</span>
                            </div>
                            <div class="scene-text">
                                SOME PROJECTS AND STUFF 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {% endfor %}
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
