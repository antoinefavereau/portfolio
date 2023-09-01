<?php
if (isset($_POST['name'])) {
    //user posted variables
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $subject = "SITE : " . $_POST['subject'];
    $message = $_POST['message'];

    //php mailer variables
    $to = get_option('admin_email');
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";

    //Here put your Validation and send mail
    $sent = wp_mail($to, $subject, strip_tags($message), $headers);

    if ($sent) {
        echo "<script>alert('Message sent');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<section id="footer">
    <div class="container">
        <div class="informations">
            <h2><?= pll_e("Contact me") ?></h2>
            <p class="text"><?= pll_e("You have an interesting project and want to work with me ?") ?></p>
            <ul>
                <li>
                    <a href="mailto:antoinefavereau45@gmail.com" class="hover">
                        <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.6666 15L20 20.8333L28.3333 15" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.33337 28.3335V11.6668C3.33337 10.7828 3.68456 9.93493 4.30968 9.30981C4.93481 8.68469 5.78265 8.3335 6.66671 8.3335H33.3334C34.2174 8.3335 35.0653 8.68469 35.6904 9.30981C36.3155 9.93493 36.6667 10.7828 36.6667 11.6668V28.3335C36.6667 29.2176 36.3155 30.0654 35.6904 30.6905C35.0653 31.3156 34.2174 31.6668 33.3334 31.6668H6.66671C5.78265 31.6668 4.93481 31.3156 4.30968 30.6905C3.68456 30.0654 3.33337 29.2176 3.33337 28.3335Z" stroke="currentcolor" stroke-width="1.5" />
                        </svg>
                        <span>antoinefavereau45@gmail.com</span>
                    </a>
                </li>
                <li>
                    <a href="tel:+33677455362" class="hover">
                        <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.1967 24.5035L23.3334 25.8335C18.6967 23.5068 15.8334 20.8335 14.1667 16.6668L15.45 9.7835L13.025 3.3335H6.77336C4.89336 3.3335 3.41336 4.88683 3.69503 6.74516C4.39503 11.3835 6.4617 19.7952 12.5 25.8335C18.8417 32.1752 27.9767 34.9268 33.0034 36.0218C34.945 36.4435 36.6667 34.9302 36.6667 32.9418V26.9685L30.1967 24.5035Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>+33 6 77 45 53 62</span>
                    </a>
                </li>
                <li>
                    <a href="https://goo.gl/maps/kectoAHXbPVfRFMw7" class="hover" target="_blank">
                        <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M33.3333 16.6668C33.3333 24.0302 20 36.6668 20 36.6668C20 36.6668 6.66663 24.0302 6.66663 16.6668C6.66663 13.1306 8.07138 9.73922 10.5719 7.23874C13.0724 4.73825 16.4637 3.3335 20 3.3335C23.5362 3.3335 26.9276 4.73825 29.428 7.23874C31.9285 9.73922 33.3333 13.1306 33.3333 16.6668Z" stroke="currentcolor" stroke-width="1.5" />
                            <path d="M20 18.3333C20.4421 18.3333 20.866 18.1577 21.1786 17.8452C21.4911 17.5326 21.6667 17.1087 21.6667 16.6667C21.6667 16.2246 21.4911 15.8007 21.1786 15.4882C20.866 15.1756 20.4421 15 20 15C19.558 15 19.1341 15.1756 18.8215 15.4882C18.509 15.8007 18.3334 16.2246 18.3334 16.6667C18.3334 17.1087 18.509 17.5326 18.8215 17.8452C19.1341 18.1577 19.558 18.3333 20 18.3333Z" fill="currentcolor" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>D207, 2 rue de la Folie 45000 Orléans</span>
                    </a>
                </li>
            </ul>
        </div>
        <form action="" method="post">
            <div class="field half">
                <input type="text" name="name" id="inputName" required>
                <label for="inputName"><?= pll_e("Name") ?></label>
            </div>
            <div class="field half">
                <input type="email" name="mail" id="inputMail" required>
                <label for="inputMail"><?= pll_e("Mail") ?></label>
            </div>
            <div class="field">
                <input type="text" name="subject" id="inputSubject" list="subjectChoice" required>
                <datalist id="subjectChoice">
                    <option value="Front-end">
                    <option value="Basic website">
                    <option value="E-commerce">
                </datalist>
                <label for="inputSubject"><?= pll_e("Subject") ?></label>
            </div>
            <div class="field">
                <textarea name="message" id="inputMessage" cols="30" rows="10" required></textarea>
                <label for="inputMessage"><?= pll_e("Message") ?></label>
            </div>
            <div class="field">
                <input type="submit" value="<?= pll_e("send") ?>">
            </div>
        </form>
    </div>
    <div class="links">
        <a href="https://www.linkedin.com/in/antoine-favereau" class="cursorButton" title="linkedin" target="_blank">
            <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.3333 56.6667V33.3333M70 26.6667V53.3333C70 57.7536 68.2441 61.9928 65.1184 65.1184C61.9928 68.2441 57.7536 70 53.3333 70H26.6667C22.2464 70 18.0072 68.2441 14.8816 65.1184C11.7559 61.9928 10 57.7536 10 53.3333V26.6667C10 22.2464 11.7559 18.0072 14.8816 14.8816C18.0072 11.7559 22.2464 10 26.6667 10H53.3333C57.7536 10 61.9928 11.7559 65.1184 14.8816C68.2441 18.0072 70 22.2464 70 26.6667Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M36.6666 56.6667V45.8334M36.6666 45.8334V33.3334M36.6666 45.8334C36.6666 33.3334 56.6666 33.3334 56.6666 45.8334V56.6667M23.3333 23.3667L23.3666 23.3301" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <a href="https://github.com/IIgolderII" class="cursorButton" title="github" target="_blank">
            <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M53.3334 73.4235V63.8568C53.4585 62.2673 53.2437 60.6695 52.7035 59.1694C52.1632 57.6694 51.3098 56.3015 50.2001 55.1568C60.6667 53.9901 71.6667 50.0235 71.6667 31.8235C71.6659 27.1695 69.8757 22.6941 66.6667 19.3235C68.1863 15.2518 68.0788 10.7513 66.3667 6.75679C66.3667 6.75679 62.4334 5.59012 53.3334 11.6901C45.6934 9.61953 37.6401 9.61953 30.0001 11.6901C20.9001 5.59012 16.9667 6.75679 16.9667 6.75679C15.2547 10.7513 15.1472 15.2518 16.6667 19.3235C13.4338 22.7191 11.6418 27.235 11.6667 31.9235C11.6667 49.9901 22.6667 53.9568 33.1334 55.2568C32.0367 56.39 31.191 57.7415 30.6511 59.2232C30.1113 60.7049 29.8894 62.2837 30.0001 63.8568V73.4235M30.0001 66.7568C20.0001 70.0001 11.6667 66.7568 6.66675 56.7568" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <a href="https://gitlab.com/antoinefavereau45" class="cursorButton" title="gitlab" target="_blank">
            <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M56.8565 8.47999C56.899 8.34797 56.9817 8.23248 57.0929 8.14963C57.2041 8.06677 57.3384 8.02066 57.477 8.01773C57.6157 8.01479 57.7518 8.05518 57.8665 8.13325C57.9811 8.21133 58.0685 8.32322 58.1165 8.45332L68.4966 36.1533L73.1566 48.5867C73.2076 48.7233 73.2125 48.873 73.1703 49.0127C73.1282 49.1524 73.0414 49.2744 72.9232 49.36L40.3899 73.0467C40.276 73.1293 40.1389 73.1738 39.9982 73.1738C39.8575 73.1738 39.7204 73.1293 39.6065 73.0467L7.07322 49.36C6.95635 49.2741 6.87066 49.1525 6.82916 49.0135C6.78765 48.8746 6.79259 48.7259 6.84322 48.59L11.5032 36.1567L12.0599 34.6567L21.8732 8.45332C21.9213 8.32322 22.0087 8.21133 22.1233 8.13325C22.2379 8.05518 22.3741 8.01479 22.5127 8.01773C22.6514 8.02066 22.7857 8.06677 22.8969 8.14963C23.0081 8.23248 23.0907 8.34797 23.1332 8.47999L31.3665 33.8133C31.4107 33.9464 31.4957 34.0621 31.6094 34.1441C31.7231 34.2261 31.8597 34.2701 31.9999 34.27H47.9999C48.1405 34.2699 48.2774 34.2253 48.3912 34.1427C48.5049 34.0601 48.5896 33.9436 48.6332 33.81L56.8565 8.47999Z" stroke="currentcolor" stroke-width="2" />
            </svg>
        </a>
        <a href="https://codepen.io/IIgolderII" class="cursorButton" title="codepen" target="_blank">
            <svg width="60" height="60" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M70 30V50M70 30L40 10M70 30L40 50M10 50V30M10 30L40 50M10 30L40 10M40 70V50M40 10V30" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M40 70L10 50L40 30L70 50L40 70Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
</section>
<div id="cursor"></div>
</body>