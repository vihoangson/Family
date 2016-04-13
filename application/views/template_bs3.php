	<h1>h1. Bootstrap heading</h1>
	<h2>h2. Bootstrap heading</h2>
	<h3>h3. Bootstrap heading</h3>
	<h4>h4. Bootstrap heading</h4>
	<h5>h5. Bootstrap heading</h5>
	<h6>h6. Bootstrap heading</h6>
	<h1>h1. Bootstrap heading <small>Secondary text</small></h1>
	<h2>h2. Bootstrap heading <small>Secondary text</small></h2>
	<h3>h3. Bootstrap heading <small>Secondary text</small></h3>
	<h4>h4. Bootstrap heading <small>Secondary text</small></h4>
	<h5>h5. Bootstrap heading <small>Secondary text</small></h5>
	<h6>h6. Bootstrap heading <small>Secondary text</small></h6>

	<div class="well">
		<a class="btn btn-default" href="#" role="button">Link</a>
		<button class="btn btn-default" type="submit">Button</button>
		<input class="btn btn-default" type="button" value="Input">
		<input class="btn btn-default" type="submit" value="Submit">
	</div>

	<div class="well">
		<!-- Standard button -->
		<button type="button" class="btn btn-default">Default</button>

		<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
		<button type="button" class="btn btn-primary">Primary</button>

		<!-- Indicates a successful or positive action -->
		<button type="button" class="btn btn-success">Success</button>

		<!-- Contextual button for informational alert messages -->
		<button type="button" class="btn btn-info">Info</button>

		<!-- Indicates caution should be taken with this action -->
		<button type="button" class="btn btn-warning">Warning</button>

		<!-- Indicates a dangerous or potentially negative action -->
		<button type="button" class="btn btn-danger">Danger</button>

		<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
		<button type="button" class="btn btn-link">Link</button>
	</div>

	<div class="well">
		<button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
		<button type="button" class="btn btn-default btn-lg btn-block">Block level button</button>
	</div>

	<div class="well">
		<p class="bg-primary">bg-primary</p>
		<p class="bg-success">bg-success</p>
		<p class="bg-info">bg-info</p>
		<p class="bg-warning">bg-warning</p>
		<p class="bg-danger">bg-danger</p>
	</div>

	<div class="well">
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Dropdown
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			</ul>
		</div>
	</div>



	<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Material Design Switch Demos</div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        Bootstrap Switch Default
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionDefault" class="label-default"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Bootstrap Switch Primary
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionPrimary" class="label-primary"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Bootstrap Switch Success
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionSuccess" class="label-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Bootstrap Switch Info
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionInfo" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionInfo" class="label-info"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Bootstrap Switch Warning
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionWarning" class="label-warning"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Bootstrap Switch Danger
                        <div class="material-switch pull-right">
                            <input id="someSwitchOptionDanger" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionDanger" class="label-danger"></label>
                        </div>
                    </li>
                </ul>
            </div>            
        </div>
    </div>
</div>