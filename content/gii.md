/*
Title: Using Gii
*/

#Gii

You can access Gii through the following URL:

    http://site.com/gii/

- Create a new table, by duplicating `demo` table provided in database.
- Make sure following directories are writable: `/frontend/controller` `/frontend/model` `/frontend/model/search` `/frontend/views`

To create Model from a table

    http://site.com/gii/default/view?id=model

To create CRUD from a table

    http://site.com/gii/default/view?id=crud

Example usage:

- Model Class: `frontend\models\Demo`
- Search Model Class: `frontend\models\search\DemoSearch`
- Controller class: `frontend\controllers\DemoController`

To add newly Created CRUD into admin panel, edit: `/common/config/params.php` and update `adminMenu` with new entry.
Example:

    ['controller' => 'demo', 'title' => 'Demo', 'icon' => 'fa fa-bars'],

Then visit side bar at:

    http://site.com/admin

Optional, you can move newly created view files to themes directory, for example

From `/frontend/views/demo`
To `/frontend/web/themes/basic/demo`