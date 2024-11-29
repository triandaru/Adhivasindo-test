<div class="card">
    <div class="card-header" style="background-image: url('{{ asset($image) }}');">
        <span class="category">{{ $category }}</span>
    </div>
    <div class="card-body">
        <h4>MATERI KOMPETENSI</h4>
        <ul>
            @foreach ($competencies as $competency)
                <li>{{ $competency }}</li>
            @endforeach
        </ul>
    </div>
</div>
