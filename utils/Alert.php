<?php
class Alert
{
    static function showAlert()
    {
        if (isset($_SESSION['alert_msg'])) {
            $msg = $_SESSION['alert_msg'];
            $echo_value =  '
            <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-body">
                        <p>'.$msg.'</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                    </div>
                </div>
            </div>
            
            ';
            $echo_value .= "
            <script type=\"text/javascript\">
                $(window).on('load', function() {
                    $('#alertModal').modal('show');
                });
            </script>
            ";
            echo($echo_value);
            unset($_SESSION['alert_msg']);
        }
    }

    static function setAlertMessage($msg)
    {
        $_SESSION['alert_msg'] = $msg;
    }
}
