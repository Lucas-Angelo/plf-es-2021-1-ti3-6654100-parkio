<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">ParkIO</strong>
            <small>Agora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    <div class="toast-body">
        <span id="toast-msg"></span>
    </div>
</div>
<script>
    function showToast(message){
        
        document.getElementById("toast-msg").innerHTML = message;
        new bootstrap.Toast( document.getElementById("liveToast") ).show();
        
    }
    
</script>