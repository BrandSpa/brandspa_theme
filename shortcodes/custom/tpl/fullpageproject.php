<div 
class="fullpage" 
style="{{ (bgimage) ? 'background: url('~bgimage~')' : (bgcolor) ? 'background:'~bgcolor : '' }}">
    <div class="row d-flex h-100">
        <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-10 project-info" style="{{ (textcolor) ? 'color:'~textcolor: '' }}">
                <div class="w-100 project-category pb-3">
                    {{category | raw }}
                </div>
                <div class="w-100 project-title pb-5">
                    {{title | raw }}
                </div>
                <div class="w-100 project-description pb-5">
                    {{description | raw }}
                </div>
                <div class="w-100 project-link pb-5">
                    <a style="{{ (textcolor) ? 'color:'~textcolor: '' }}" href="{{ project }}">
                        {% if lang == 'es_CO' %}
                            Ver más
                        {% else %}
                            View more
                        {% endif %}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
            {% if logoimage %}
                <div class="logo col-md-8 col-8">
                    <img src="{{logoimage}}" alt="{{title}}">
                </div>
            {% endif %}
        </div>
    </div>
</div>