<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Resume</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../global/styles.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>My Resume</h1>
        <span>
            <p>You can view my resume below.</p>
        </span>
        <div class="resume-container">
            <object data="../resume/resume.pdf" type="application/pdf" width="100%" height="600">
                <p>
                    Your browser does not support PDFs. Please download the PDF to view it:
                    <a href="../files/resume.pdf">Download Resume</a>
                </p>
            </object>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>