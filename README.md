# Cloud Photo Gallery - Static Website Hosting on AWS S3

This project provides a static HTML-based photo gallery hosted on an AWS S3 bucket, configured for static website hosting.

## Table of Contents
- Overview
- Prerequisites
- Steps to Host on AWS S3
- Running Locally
- Configuration for S3 Bucket
- Demo Link
- License

## Overview
This repository contains the HTML, CSS, and JavaScript files for a responsive and organized photo gallery that you can host on an Amazon S3 bucket. Once set up, the gallery will be accessible as a publicly available static website.

## Prerequisites
- An AWS account
- An IAM user with appropriate permissions for S3
- Basic knowledge of HTML and S3
- AWS CLI installed (optional, but recommended for convenient S3 uploads)

## Steps to Host on AWS S3

### 1. Create an S3 Bucket
- Navigate to the S3 service in the AWS Management Console and click on "Create bucket."
- Provide a unique name for your bucket (e.g., `my-photo-gallery`) and select an appropriate region.

### 2. Enable Static Website Hosting
- In your S3 bucket settings, go to **Properties** > **Static website hosting**.
- Choose "Enable" and specify the index document as `index.html`.
- Optionally, configure an error document (e.g., `404.html`).

### 3. Set Bucket Policy for Public Access
- Navigate to **Permissions** > **Bucket Policy**.
- Add the following policy to allow public access:
  ```json
  {
    "Version": "2012-10-17",
    "Statement": [
      {
        "Sid": "PublicReadGetObject",
        "Effect": "Allow",
        "Principal": "*",
        "Action": "s3:GetObject",
        "Resource": "arn:aws:s3:::your-bucket-name/*"
      }
    ]
  }
  ```
  Replace `your-bucket-name` with your actual bucket name.

### 4. Upload Files
- Upload your HTML, CSS, JavaScript, and image files to the S3 bucket. You can do this through the S3 console via drag-and-drop or by using the AWS CLI:
  ```bash
  aws s3 sync . s3://your-bucket-name --acl public-read
  ```

### 5. Access Your Website
- Once the files are uploaded, navigate to the **Properties** section of your S3 bucket.
- Copy the Static website hosting URL to access your gallery.

## Running Locally
To test the website locally before deployment:
- Open the `index.html` file in a web browser.
- Verify that all images, carousels, and other features are functioning as intended.

## Configuration for S3 Bucket
Ensure that all HTML, CSS, and JavaScript files are publicly accessible. Review your bucket policy and adjust file permissions as necessary.

## Demo Link
After deploying your gallery, access it via the link provided in your bucket's Static website hosting settings.

---

Feel free to customize and enhance this setup to fit your specific requirements!
