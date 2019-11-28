<!-- JS -->
<script src="<?= baseUrl ?>assets/js/validarPass.js"></script>
<!-- El Pooper -->
<script src="<?= baseUrl ?>assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?= baseUrl ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= baseUrl ?>assets/datatables/datatables.min.js"></script>
<script type="text/javascript">
    var IDLE_TIMEOUT = 600; // 10 minutes of inactivity
    var _idleSecondsCounter = 0;
    document.onclick = function() {
        _idleSecondsCounter = 0;
    };
    document.onmousemove = function() {
        _idleSecondsCounter = 0;
    };
    document.onkeypress = function() {
        _idleSecondsCounter = 0;
    };
    window.setInterval(CheckIdleTime, 1000);

    function CheckIdleTime() {
        _idleSecondsCounter++;
        var oPanel = document.getElementById("SecondsUntilExpire");
        if (oPanel)
            oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
        if (_idleSecondsCounter >= IDLE_TIMEOUT) {
            // destroy the session in logout.php
            document.location.href = "../usuario/logout";
        }
    }
</script>
