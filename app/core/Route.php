<?php 
namespace app\core;
class Route
{
	static function start()
	{
		// ���������� � �������� �� ���������
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// �������� ��� �����������
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// �������� ��� ������
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// ��������� ��������
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// ���������� ���� � ������� ������ (����� ������ ����� � �� ����)
		$model = "app\\models\\".$model_name;
		$controller = "app\\controllers\\".$controller_name;
		
		// ������� ����������
		$controller = new $controller;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// �������� �������� �����������
			$controller->$action();
		}
		else
		{
			// ����� ����� �������� ���� �� ������ ����������
			Route::ErrorPage404();
		}
	
	}


	function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
}
