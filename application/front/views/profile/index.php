<?php

echo 'Welcome, '. $this->session->userdata('FIRST_NAME'). ' '.$this->session->userdata('LAST_NAME');
