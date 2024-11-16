 {{-- Create Post Model --}}
 <!-- Modal -->
 <div class="modal fade" id="CreatePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="form-control" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                         <label for="media" class="form-label">Upload Media</label>
                         <input class="form-control" type="file" id="media" name="media" multiple>
                     </div>
                     <div class="mb-3">
                         <label for="content" class="form-label">Write Notes</label>
                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="whats on your mind"
                             name="content"></textarea>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Share</button>
             </div>
         </div>
     </div>
 </div>
