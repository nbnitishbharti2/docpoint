@php
$elementName = 'Backend.admin_left_nav';
$userData = Auth::user();
$groupId = $userData->user_group_id;
if($groupId == 2){
	$elementName = 'Backend.doc_left_nav';
}
@endphp
@component ($elementName) @endcomponent


