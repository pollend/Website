<div class="alert alert-warning">
	Only alter these settings when you're certain with what you're doing.
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label for="name">
				Mod dependencies
			</label>

			<p>
				Specify your mod dependencies, the client will download these mods first and add them as compiler references.
			</p>

			<div id="dependencies-box">
				<select id="dependencies" ng-controller="ParkitectNexus.Stockroom.DependencyController" multiple="multiple" name="dependencies[]">
					@foreach($mods as $mod)
						<option value="{{ $mod->identifier }}")>{{ $mod->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>
