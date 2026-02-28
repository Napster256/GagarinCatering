<?php

/**
 * @file
 * Contains form handler.
 */

if (isset($_POST)) {
  $subject = filter_input(INPUT_POST, 'title-email', FILTER_SANITIZE_STRING);
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

  // Mail body.
  $body = [
    "Имя: $name",
    "Телефон: $phone",
    "Email: $email",
  ];

  // Consultation form.
  if (!isset($subject)) {
    $subject = 'Нужна консультация';
    array_pop($body);
  }

  // @todo Replace with real mails.
  $from = 'no-reply@gagarin-catering.ru';
  $to = 'example@ya.ru';

  // Mail headers.
  $headers = [
    'Content-Type' => 'text/plain; charset=UTF-8',
    'From' => $from,
    'MIME-Version' => '1.0',
    'Return-Path' => $from,
    'Sender' => $from,
    'X-Mailer' => 'PHP/' . phpversion(),
  ];

  // Process body and headers.
  foreach ($headers as $name => $value) {
    $headers[] = "$name: $value";
    unset($headers[$name]);
  }

  $headers = implode("\n", $headers);
  $body = implode("\n", $body);

  // Send mail.
  mail($to, $subject, $body, $headers);
}

// Redirect to main page.
header('Location: /');
exit;
