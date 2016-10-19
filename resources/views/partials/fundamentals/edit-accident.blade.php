<div class="modal-window" id="edit-accident">
<div class="modal-margin">
	<form action ="/editaccident" method="POST" class="edit-form ajaxform" data-edit="accident">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="project_id" name="project_id" type="hidden" value="1">
        <input id="accident_id" name="accident_id" type="hidden" value="2">

		<label for="accident_name" class="modal-title">
		    New accident name
		</label>
		<section class="modal-content">
			<textarea id="accident_name" name="accident_name" type="text" class="add-drop__input" required></textarea>
		</section>
		<button class="modal-title">Send</button>
	</form>
</div>
 </div>
 
<!-- mascara para cobrir o site -->  
<div id="modal-mask"></div>