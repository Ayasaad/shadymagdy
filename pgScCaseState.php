<?php 
require_once('config.php');

?>


<form action="#" class="horizontal-form">
												<h3 class="form-section">Person Info</h3>
												<div class="row-fluid">
													<div class="span6 ">
														<div class="control-group">
															<label class="control-label" for="firstName">First Name</label>
															<div class="controls">
																<input type="text" id="firstName" class="m-wrap span12" placeholder="Chee Kin">
																<span class="help-block">This is inline help</span>
															</div>
														</div>
													</div>
													 
												</div>
												<!--/row-->
												<div class="row-fluid">
													<div class="span6 ">
														<div class="control-group">
															<label class="control-label" >Gender</label>
															<div class="controls">
																<select  class="m-wrap span12">
																	<option value="">Male</option>
																	<option value="">Female</option>
																</select>
																<span class="help-block">Select your gender.</span>
															</div>
														</div>
													</div>
													 
												</div>
												<!--/row-->        
												<div class="row-fluid">
													<div class="span6 ">
														<div class="control-group">
															<label class="control-label" >Category</label>
															<div class="controls">
																<select class="span12 select2_category" data-placeholder="Choose a Category" tabindex="1">
																	<option value="">&nbsp;</option>
																	<option value="Category 1">Category 1</option>
																	<option value="Category 2">Category 2</option>
																	<option value="Category 3">Category 5</option>
																	<option value="Category 4">Category 4</option>
																</select>
															</div>
														</div>
													</div>
													 
												</div>
												
											</form>