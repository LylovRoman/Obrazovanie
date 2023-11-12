@extends('template')

@section('title', 'Записи')

@section('content')
    <h1>{{ $report->name }}
        @if(Auth::user()->role === "user")
            <a href="{{ route('records.create') }}" style="text-decoration: none">+</a>
        @endif
    </h1>
    <table class="table">
        <thead>
        <tr>
            <th rowspan="2">№</th>
            <th rowspan="2">Наименование образовательной организации (филиала)</th>
            <th rowspan="2">Программы подготовки</th>
            <th rowspan="2">Категория стандарта</th>
            <th>Код профессии, специальности в формате хх.хх.хх</th>
            <th rowspan="2">Наименование специальности</th>
            <th rowspan="2">Срок обучения</th>
            <th rowspan="2">Форма обучения</th>
            <th rowspan="2">Курс</th>
            <th></th>
            <th rowspan="2">Количество КЦП согласно приказу учредителя</th>
            <th rowspan="2">Количество студентов всего</th>
            <th colspan="4">Из них количество студентов и источник финансового обеспечения, руб.</th>
            <th rowspan="2">Количество иностранных студентов, чел.</th>
            <th></th>
            <th rowspan="2">Количество детей, оставшихся без попечения родителей, чел.</th>
            <th rowspan="2">Количество студентов нуждающихся в общежитии, чел.</th>
            <th rowspan="2">из них (гр.20) предоставлено место в общежитии, чел.</th>
            <th rowspan="2">из них (гр.20) отказано по причине отсутствия мест в общежитии, чел.</th>
            <th rowspan="2">Выпуск в 2023г. (кол-во человек)</th>
            <th colspan="2">из них количество выпускников сдающих демонстрационный экзамен (указать количество человек)</th>
            <th colspan="2">из них (гр. 23) (Приказ Минпросвещения № 800 от 08.10.2021) демонстрационный экзамен проводился на (указать количество человек)</th>
        </tr>
        <tr>
            <th>в соответствии с приказом Минобрнауки России от 29 октября 2013 г. № 1199</th>
            <th>Средний балл аттестат (для I курса)</th>
            <th>Количество студентов, обучающихся за счёт средств федерального бюджета</th>
            <th>Количество студентов, обучающихся за счёт средств бюджета субъекта РФ</th>
            <th>Количество студентов, обучающихся по целевому обучению (в т.ч. из гр.13 или 14)</th>
            <th>Количество студентов, обучающихся на основании договоров об оказании платных образовательных услуг</th>
            <th>Количество детей-сирот, чел.</th>
            <th>в рамках ГИА</th>
            <th>в рамках промежуточной аттестации</th>
            <th>базовом уровне</th>
            <th>профессиональном уровне</th>
            @if(Auth::user()->role === "user")
                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
            @endif
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
            <th>17</th>
            <th>18</th>
            <th>19</th>
            <th>20</th>
            <th>21</th>
            <th>22</th>
            <th>23</th>
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th></th><th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <th scope="row"><a href="{{ route('records.show', compact('record'))}}">{{ $record->id }}</a></th>
                <td>{{ $record->user->name }}</td>
                <td>{{ $record->program }}</td>
                <td>{{ $record->category }}</td>
                <td>{{ $record->getProfessionCode() }}</td>
                <td>{{ $record->getProfessionName() }}</td>
                <td>{{ $record->duration }}</td>
                <td>{{ $record->form }}</td>
                <td>{{ $record->course }}</td>
                <td>{{ $record->avg_score }}</td>
                <td>{{ $record->KCP }}</td>
                <td>{{ $record->students_all }}</td>
                <td>{{ $record->students_federal }}</td>
                <td>{{ $record->students_subject }}</td>
                <td>{{ $record->students_target }}</td>
                <td>{{ $record->students_paid }}</td>
                <td>{{ $record->students_foreigner }}</td>
                <td>{{ $record->students_orphan }}</td>
                <td>{{ $record->students_without_care }}</td>
                <td>{{ $record->need }}</td>
                <td>{{ $record->provided }}</td>
                <td>{{ $record->refused }}</td>
                <td>{{ $record->release }}</td>
                <td>{{ $record->GIA }}</td>
                <td>{{ $record->interim_certification }}</td>
                <td>{{ $record->basic_level }}</td>
                <td>{{ $record->professional_level }}</td>
                @if(Auth::user()->role === "user")
                    <th scope="col"><a href="{{ route('records.edit', ['record' => $record]) }}" style="text-decoration: none">✏️</a></th>
                    <th scope="col"><a href="{{ route('records.destroy', ['record' => $record]) }}" style="text-decoration: none">❌</a></th>
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2">ИТОГО:</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $sum['KCP'] }}</td>
            <td>{{ $sum['students_all'] }}</td>
            <td>{{ $sum['students_federal'] }}</td>
            <td>{{ $sum['students_subject'] }}</td>
            <td>{{ $sum['students_target'] }}</td>
            <td>{{ $sum['students_paid'] }}</td>
            <td>{{ $sum['students_foreigner'] }}</td>
            <td>{{ $sum['students_orphan'] }}</td>
            <td>{{ $sum['students_without_care'] }}</td>
            <td>{{ $sum['need'] }}</td>
            <td>{{ $sum['provided'] }}</td>
            <td>{{ $sum['refused'] }}</td>
            <td>{{ $sum['release'] }}</td>
            <td>{{ $sum['GIA'] }}</td>
            <td>{{ $sum['interim_certification'] }}</td>
            <td>{{ $sum['basic_level'] }}</td>
            <td>{{ $sum['professional_level'] }}</td>
        </tr>
        </tfoot>
    </table>
@endsection
