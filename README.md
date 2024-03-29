<div id="top"></div>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/rpmcmurphy/programming-notetaker.git">
    <img src="public/images/programming-notes-logo.png?raw=true" alt="Programming notetaker logo" width="80" height="80">
  </a>

<h3 align="center">Take notes, save code-snippets and search them back for later use conveniently.</h3>

  <p align="center">
    A project to help take notes and store code snippets on different topics and browse through later for convenience.
    <br />
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

![Research notetaker](public/images/programming-notes.png)

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

-   [Laravel](https://laravel.com/)
-   [Bootstrap](https://getbootstrap.com)
-   [jQuery](https://jquery.com)
-   [MySQL](https://www.mysql.com)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

Clone the repo and install as instructed below.

### Prerequisites

You will need Laravel 8. Here are some of the things I have done in the project-

1. Used Laarvel Mix for the implementation of Sass and asset management
2. Customized Bootstrap to change the colos and other parts
3. Has conditional search implementation
4. Seelc2 for multi-select implementation
5. Eloquent relationship implementation

-   npm
    ```sh
    npm install npm@latest -g
    ```

### Installation

1. First clone this repository, install the dependencies, and setup your .env file.

2. Then create the necessary database.
    ```sh
    php artisan db
    create database research-details
    ```
3. And run the initial migrations and seeders.
    ```sh
    php artisan migrate
    ```
4. Install the necessary dependencies for Laarvel Mix
    ```sh
    npm install
    ```
5. Serve the application with- 
    ```sh
    php artisan serve
    ```

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

This application can be used to build a personal database on topics you add, plus the details on each topic, and code snippets which can be viewed or copied later with syntax highlighting. First, add Category or Tags like Laravel, NodeJS, etc. Then add any number of NOTES under each category or tag. That way you will be able to track/bookmark things and some details about it for later reference. It will serve as a bookmark for you, with unlimited number or amount of notes you want to save for later reference. Searching them back is super easy and granualar. Enjoy!

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

-   [ ] Implement API
-   [ ] Replace the front-end with React
-   [X] Add option for multi-category/tag detail for more flexibility

See the [open issues](https://github.com/github_username/repo_name/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

[@ParbezRipon](https://twitter.com/ParbezRipon)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/github_username/repo_name.svg?style=for-the-badge
[contributors-url]: https://github.com/github_username/repo_name/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/github_username/repo_name.svg?style=for-the-badge
[forks-url]: https://github.com/github_username/repo_name/network/members
[stars-shield]: https://img.shields.io/github/stars/github_username/repo_name.svg?style=for-the-badge
[stars-url]: https://github.com/github_username/repo_name/stargazers
[issues-shield]: https://img.shields.io/github/issues/github_username/repo_name.svg?style=for-the-badge
[issues-url]: https://github.com/github_username/repo_name/issues
