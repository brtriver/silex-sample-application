Silex Blog Sample Application
==============================
- use extentions
 - Twig
 - Doctrine DBAL

set up
-------

$ git clone git://github.com/brtriver/silex-sample-application.git silex-sample-application
$ cd silex-sample-application 
$ git submodule update --init

notice: you have to create a database. see app/blog.php file.

SQL::

CREATE TABLE IF NOT EXISTS `Posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SQL::

INSERT INTO `Posts` (`id`, `name`, `body`, `created`, `modified`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus.\r\nNulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.', '2011-07-30 13:19:05', '2011-07-30 13:19:05');


at last, you can see a sample page:
http://example.com/path-to-sample/web/index.php/blog