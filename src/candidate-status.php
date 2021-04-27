<?php
include_once 'Candidate.php';

if (isset($_POST['candidate_status'])) {
  $proceed = new Candidate($_POST);
  $proceed->update_status();
}

