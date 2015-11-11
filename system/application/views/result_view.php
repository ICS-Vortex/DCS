			<!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style1">
						<div class="inner">

							<!-- Feature 1 -->
								<section class="container box feature1">
									<div class="row">
										<div class="12u">
											<header class="first major">
												<h2 style="color: green;">Операцію успішно виконано!</h2>
                                                <button type="button" class="btn btn-default" id="return_button">
                                                    Назад
                                                </button>  <br />   
											</header>
										</div>
									</div>
                            <div id="rem_answer"></div><!-----ТАБЛИЦЯ------>                        
						</div>
                        </section>
					</div>
                    <script>
                        $(document).ready(function(){
                           $('#return_button').click(function(){
                                window.location.href = '<?=base_url();?>main';
                           }); 
                        });
                    </script>
