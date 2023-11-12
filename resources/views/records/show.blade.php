@extends('template')

@section('title', 'Запись')

@section('content')
    <h1>Запись от {{ $record->user->name }}</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Номер записи</strong>: {{ $record->id }}</li>
        <li class="list-group-item"><strong>Наименование образовательной организации (филиала)</strong>: {{ $record->user->name }}</li>
        <li class="list-group-item"><strong>Программы подготовки (ППССЗ/ППКРС)</strong>: {{ $record->program }}</li>
        <li class="list-group-item"><strong>Категория стандарта</strong>: {{ $record->category }}</li>
        <li class="list-group-item"><strong>Код профессии, специальности в формате хх.хх.хх</strong>: {{ $record->getProfessionCode() }}</li>
        <li class="list-group-item"><strong>Наименование специальности</strong>: {{ $record->getProfessionName() }}</li>
        <li class="list-group-item"><strong>Срок  обучения</strong>: {{ $record->duration }}</li>
        <li class="list-group-item"><strong>Форма обучения</strong>: {{ $record->form }}</li>
        <li class="list-group-item"><strong>Курс</strong>: {{ $record->course }}</li>
        <li class="list-group-item"><strong>Средний балл аттестат (для I курса)</strong>: {{ $record->avg_score }}</li>
        <li class="list-group-item"><strong>Количество КЦП согласно приказу учредителя</strong>: {{ $record->KCP }}</li>
        <li class="list-group-item"><strong>Количество студентов всего</strong>: {{ $record->students_all }}</li>
        <li class="list-group-item"><strong>Количество студентов, обучающихся за счёт средств федерального бюджета</strong>: {{ $record->students_federal }}</li>
        <li class="list-group-item"><strong>Количество студентов, обучающихся за счёт средств бюджета субъекта РФ</strong>: {{ $record->students_subject }}</li>
        <li class="list-group-item"><strong>Количество студентов, обучающихся по целевому обучению</strong>: {{ $record->students_target }}</li>
        <li class="list-group-item"><strong>Количество студентов, обучающихся на основании договоров об оказании платных образовательных услуг</strong>: {{ $record->students_paid }}</li>
        <li class="list-group-item"><strong>Количество иностранных студентов</strong>: {{ $record->students_foreigner }}</li>
        <li class="list-group-item"><strong>Количество детей-сирот</strong>: {{ $record->students_orphan }}</li>
        <li class="list-group-item"><strong>Количество детей, оставшихся без попечения родителей</strong>: {{ $record->students_without_care }}</li>
        <li class="list-group-item"><strong>Количество студентов нуждающихся в общежитии</strong>: {{ $record->need }}</li>
        <li class="list-group-item"><strong>Предоставлено мест в общежитии</strong>: {{ $record->provided }}</li>
        <li class="list-group-item"><strong>Отказано по причине отсутствия мест в общежитии</strong>: {{ $record->refused }}</li>
        <li class="list-group-item"><strong>Выпуск  в 2023г. (кол-во человек)</strong>: {{ $record->release }}</li>
        <li class="list-group-item"><strong>Выпускников  сдающих демонстрационный экзамен в рамках ГИА</strong>: {{ $record->GIA }}</li>
        <li class="list-group-item"><strong>Выпускников  сдающих демонстрационный экзамен в рамках промежуточной аттестации</strong>: {{ $record->interim_certification }}</li>
        <li class="list-group-item"><strong>Демонстрационный экзамен проводился на базовом уровне</strong>: {{ $record->basic_level }}</li>
        <li class="list-group-item"><strong>Демонстрационный экзамен проводился на профессиональном уровне</strong>: {{ $record->professional_level }}</li>
    </ul>
@endsection
