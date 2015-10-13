{% extends "layouts/main_layout.php" %}

{% block title %} Home {% endblock %}
{% block head %}
    {{ parent() }}
    <style type="text/css">
        .important { color: #336699; }
    </style>
{% endblock %}
{% block content %}
<div class="section">
    <h1>Hi!</h1>
    <p class="important">
        Welcome to SlimSMT Home.
	<p><b>{{ hello }}</b></p>
    </p>
</div>
{% endblock %}