<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" id="sectionsNav">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand" href="{{ route('index') }}"><img src="/images/logo.png" height="45px" alt=""></a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
    				<li>
						<a href="{{ route('about') }}">
							 О компании
						</a>
					</li>

					<li class="dropdown">
						<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">credit_card</i> Карты
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="sections.html#headers">
									<i class="material-icons">account_balance_wallet</i> Электронный кошелек
								</a>
							</li>
							<li>
								<a href="sections.html#features">
									<i class="material-icons">local_atm</i> Банковская карта
								</a>
							</li>
							<li>
								<a href="sections.html#features">
									<i class="material-icons">directions_bus</i> Проездные
								</a>
							</li>
							<hr>
							<li>
								<a href="sections.html#blogs">
									<i class="material-icons">map</i> Где купить?
								</a>
							</li>
							<li>
								<a href="sections.html#teams">
									<i class="material-icons">streetview</i> Пункты пополнения
								</a>
							</li>
							<li>
								<a href="sections.html#projects">
									<i class="material-icons">local_library</i> Как пополнить?
								</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">contact_mail</i> Свяжитесь с нами
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="examples/about-us.html">
									<i class="material-icons">insert_comment</i> Вопросы и ответы
								</a>
							</li>
							<li>
								<a href="examples/blog-post.html">
									<i class="material-icons">create</i> Задать вопрос
								</a>
							</li>
							<li>
								<a href="examples/blog-posts.html">
									<i class="material-icons">place</i> Контакты
								</a>
							</li>
						</ul>
					</li>

        		</ul>
        	</div>
    	</div>
    </nav>