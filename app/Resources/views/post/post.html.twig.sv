{% extends 'base.html.twig' %}


{% block title %}
    {{  post.title }} | Item | Online Market for Glass Pipes, Vaporizers, & More At WickedHeady
{% endblock %}

{% block body %}



<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        {% for i in images %}
            <img src="{{ asset('uploads/brochures/' ~ i.file) | imagine_filter('my_thumb') }}" style="margin-bottom: 4px" />
        {%  endfor %}

    </div>
</div>
<div class="col-sm-8 col-lg-8 col-md-8">
    <div class="thumbnail">
        <span class="glyphicon glyphicon-bookmark" style="top: -4px; left: 4px"></span>
        <div class="caption">

            <h4 class="pull-right">{{ post.price }}</h4>
            <h4>{{ post.title }}
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>

            <a class="btn btn-success pull-right" id="submit_offer">Submit an Offer</a>

        </div>
    </div>
    <div class="thumbnail">
        <div class="caption" id="contact_form_div" style="display: none ">
            {{ form_start(contact) }}
            {{ form_widget(contact) }}
            <button type="submit" style="margin-top: 5px" class="btn btn-default" formnovalidate>Save</button>
            {{ form_end(contact) }}
        </div>
        <div class="caption" id="message_form_div"> {{ review }}
            {% if messages is empty %}
                {{ form_start(message) }}
                {{ form_widget(message) }}
                <button type="submit" style="margin-top: 5px" class="btn btn-default" formnovalidate>Save</button>
                {{ form_end(message) }}
                <div class="ratings">
                    <div id="rateYo" class="pull-left"></div>
                </div>
            {% else %} 
            {% endif %}
        </div>
    </div>
    <div class="well">
        <div class="caption">
            

            {% for m in messages if m.userId != 1 %}
                <div class="row">
                    <div class="col-md-12">
                        {% if m.userId != user_id %}
                            {% set rate = m.rating|round %}
                            {% set empty = 5-rate %}
                            {% for i in 0..rate %}
                                <span class="glyphicon glyphicon-star"></span>
                            {% endfor %}
                            {% for e in 0..empty if rate != 5 %}
                                <span class="glyphicon glyphicon-star-empty"></span>
                            {% endfor %}
                            {{m.title}}
                            <span class="pull-right"> {{ m.tstamp|date('m/d/Y') }}</span>
                            <p>{{ m.message }}
                                <span class="glyphicon glyphicon-pencil pull-right" id="message_comment "></span></p>
                        {% endif %}
                    </div>
                </div>
            {% endfor %}

        </div>

    </div>

</div>


{% endblock %}

{% block script %}

    <script>
        $(document).ready( function() {

            //handle rating
            var isMobile = window.matchMedia("only screen and (max-width: 760px)");

            if( !isMobile.matches )
            {
                $("#rateYo").rateYo({

                    rating: {{ ipRating|default(4) }},
                    spacing: "5px",
                    readOnly: {% if messages  is empty %} false {% else %} true {% endif %},

                }).on("rateyo.set", function (e, data) {

                    $('#message_form_rating').val(data.rating);

                    return false;

                    $("#rateYo").rateYo("option", "readOnly", "true");
                    $.ajax({
                        type: "POST",
                        url: "{{ path('rating_save', {'postId': post.id}) }}",
                        data: {
                            'form': data.rating
                        },
                        success: function (response) {
                            console.log(response);
                            $.growl.notice({
                                title: "Growl",
                                message: "Rating<b> " + data.rating + " </b>assigned successfully"
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });

            }
            //handle hiding & showing forms
            $('#leave_review').click(function (e){
                $('#message_form_div').fadeOut( "slow", function() {
                    $('#contact_form_div').fadeIn("slow");
                });
            });
            $('#submit_offer').click(function(){
                window.location="{{ path('offer_form', {'id': post.id}) }}";
            });
            //handle message submission
            $('form[name=message_form]').submit(function (e) {

                e.preventDefault();

                if( $('#message_form_rating').children().length === 0 )
                {
                    $.growl.notice({
                        title: "Growl",
                        message: "Please set rating"
                    });
                    return false;
                }

                var form = $('form[name="message_form"]').serializeArray();

                $.ajax({
                    type: "POST",
                    url: "{{ path('message_save', {'postId': post.id}) }}",
                    data: {
                        'form': form
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });

            });
        } );

    </script>
{% endblock %}