<?php 
namespace app\core;
class View
{
	/*
	$content_file - ���� ������������ ������� �������;
	$template_file - ����� ��� ���� ������� ������;
	$data - ������, ���������� �������� �������� ��������. ������ ����������� � ������.
	*/
	function generate($content_view, $template_view, $data = null)
	{
		/*
		����������� ���������� ����� ������ (���),
		������ �������� ����� ������������ ���
		��� ����������� �������� ���������� ��������.
		*/
		include 'application/views/'.$template_view;
	}
}
