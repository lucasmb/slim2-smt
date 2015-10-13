<!DOCTYPE html>
<html lang="en">
    <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        {% block head %}
          <!--Import jQuery-->
          <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  		         
            {% if css is defined %}
              {% for style in css %}
               <link href="css/{{ style }}" type="text/css" rel="stylesheet" media="screen,projection"/>
              {% endfor %}
    		{% endif %}
         
            <title>{% block title %}{% endblock %} - Slim App</title>
        {% endblock %}
    </head>
    <body>

    <!-- menu  -->
    {% block menu %}
		<nav class="menu">
	    </nav>
	{% endblock %}
	<!-- menu end  -->
      <div id="content">
      	{% block content %}
      		<div class="">
      		</div>
      	{% endblock %}
      </div>

    <footer class="">
     {% block footer %}
        <div class="">
		    2015 <a class="" href="http://www.slimframework.com/">slimframework</a>
	    </div>
        {% endblock %}
    </footer>
                
    {% if js is defined %}
        {% for jscript in js %}
            <script src="js/{{ jscript }}" type="text/javascript"></script>
        {% endfor %}
    {% endif %}
         
        </div>
    </body>
</html>