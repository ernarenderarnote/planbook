@extends('layouts.teacher')

@section('content')

<div class="clearfix"></div>
<div class=" class-page">
  <div class="container-fluid">
    <div class="col-sm-12">
		<div class="teacher-dash-action pt-5">

			<form method="post" action="">

			  {{ csrf_field() }}
				<!--input type='file' accept=" .pdf,  .jpg" id='file' name='file[]' multiple='1' class="fileupload btn btn-primary " />
				
				<button type="button" class="btn btn-primary bg-white border-2 border-theme add-comments popup-custom-show" id="addUnitButton" ><i class="fa fa-plus" aria-hidden="true"></i><span class="">Upload File</span></button-->
				<div class="main-buton file-attchment myFileuploads">
					<input type='file' accept=" .pdf,  .jpg" id='file' name='file[]' multiple='1' class="fileupload btn btn-primary " />
					<span class="upload-text">Upload New File</span>
				</div>
				<div class="popupProgress" style="display:none;">
					<div class='progress' id="progress_div">
						<div class='bar' id='bar1'></div>
						<div class='percent' id='Imgpercent'>0%</div>
					</div>
				</div>
			</form>
		</div>
    </div>
    <div class="table-responsive col-sm-12 pt-5">
      <table class="table table-bordered table-hover">
        <thead>
			<tr>
				<th class="text-left bg-theme class-column">File Name</th>
				<th class="text-left bg-theme class-Size">Size(Kb)</th>
				<th class="text-center bg-theme start-date">Last update</th>
			</tr>
        </thead>
        <tbody>

          @forelse($myFiles as $myFile)

            <tr class="edit_unit" data-file-id="{{ $myFile->id }}">
              <td class="text-center class-column"><span class="pull-left">{{ $myFile->file_changeable_name }}</span> <a href="{{ $myFile->file_name }}" download ><i class="fa fileDownload fa-download pull-right" targetID="{{ $myFile->id }}" aria-hidden="true"></i></a></td>
              <td class="text-center class-column">{{ $myFile->uploadSize }}</td>
			  <td class="text-center class-column">{{ $myFile->updated_at }}</td>
            </tr>

          @empty
            <tr>
              <td colspan="8">No Record Found ! </td>
            </tr>
          @endforelse

        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function(){
	$('body').on('change', '.fileupload', function(e){
    var validExts = "*.pdf; *.jpg".replace(/\s+|\*/g, '').split(";");
    for(var i=0; i<e.target.files.length; i++){
        fileExt = e.target.files[i].name.substring(e.target.files[i].name.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("Invalid file selected, valid files are of " + validExts.toString() + " types.");
            return false;
        }

        if(e.target.files[i].size > 300*1024*1024){
            alert("File too large, we only accept 300MB");
            return false;
        }
    }
    console.log(e.target.files);
    var $this = $(this);
    var formData = new FormData();
    formData.append("file", e.target.files[0]);
	formData.append("uploadSize", ((e.target.files[0].size)/1024).toFixed(2));
    formData.append("_token", $this.closest('form').find("[name='_token']").val());
    $.ajax({
	  xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt) {
		  if (evt.lengthComputable) {
			$('.popupProgress').css("display","block");  
			var percentComplete = evt.loaded / evt.total;
			percentComplete = parseInt(percentComplete * 100);
			console.log(percentComplete);
			var percentVal = percentComplete + '%';
			 $('#bar1').width(percentVal);
			 $('#Imgpercent').html(percentVal);
			if (percentComplete === 100) {

			}

		  }
		}, false);

		return xhr;
	  },		
      type:'POST',
      url: 'myFileUpload',
      data: formData,
      cache:false,
      contentType: false,
      processData: false,

      success:function(data){
        window.location.href = window.location.href;
        //$($this.data('img')).val(data);
        // $($this.data('preview')).attr('src','uploaded/img/'+data);
        //$this.closest("form").find("[type='submit']").removeAttr('disabled');
      },
      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
  }); 
    
});
</script>
@endpush