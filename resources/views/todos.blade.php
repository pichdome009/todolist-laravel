<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>កម្មវិធី Todo List</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&display=swap');

        body { 
            font-family: 'Battambang', Arial, sans-serif; 
            max-width: 700px;
            margin: 50px auto; 
        }

        input, select, button {
            font-family: 'Battambang', Arial, sans-serif;
            font-size: 15px; 
        }

        h2 { text-align: center; }
        .todo-list { list-style-type: none; padding: 0; }
        
        .todo-item { 
            margin-bottom: 10px; 
            padding: 15px; 
            background: #f4f4f4; 
            border-radius: 5px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }

        button { background: red; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 3px;}
        .add-btn { background: #28a745; height: 38px; }
        .input-group { display: flex; gap: 10px; margin-bottom: 20px; align-items: center; }
        
        input[type="text"] { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="datetime-local"], select { padding: 8px; border: 1px solid #ccc; border-radius: 3px; }
        
        .badge { background: #17a2b8; color: white; padding: 3px 8px; border-radius: 10px; font-size: 12px; margin-right: 10px; }
        .btn-edit { background: #ffc107; color: black; padding: 8px 12px; text-decoration: none; border-radius: 3px; font-size: 13px; display: inline-block;}
        .btn-complete { background: #007bff; }
        .action-buttons { display: flex; gap: 5px; align-items: center;}
    </style>
</head>
<body>

    <h2>បញ្ជីការងាររបស់ខ្ញុំ (Todo List)</h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('todo.store') }}" method="POST" class="input-group">
        @csrf
        
        <select name="category_id" required>
            <option value="" disabled selected>ជ្រើសរើសប្រភេទ...</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="text" name="title" placeholder="បញ្ចូលការងារថ្មីនៅទីនេះ..." required>
        
        <input type="datetime-local" name="due_date" title="ថ្ងៃកំណត់បញ្ចប់">

        <button type="submit" class="add-btn">បន្ថែមការងារ</button>
    </form>

    <ul class="todo-list">
        @foreach($todos as $todo)
            <li class="todo-item">
                
                <div>
                    @if($todo->category)
                        <span class="badge">{{ $todo->category->name }}</span>
                    @endif
                    
                    <span style="text-decoration: {{ $todo->is_completed ? 'line-through' : 'none' }}; color: {{ $todo->is_completed ? '#888' : '#000' }}; font-weight: bold; font-size: 16px;">
                        {{ $todo->title }}
                    </span>
                    
                    @if($todo->due_date)
                        <div style="font-size: 13px; color: #dc3545; margin-top: 8px;">
                            ⏰ ផុតកំណត់៖ {{ $todo->due_date->format('d/m/Y ម៉ោង h:i A') }}
                        </div>
                    @endif
                </div>
                
                <div class="action-buttons">
                    <form action="{{ route('todo.complete', $todo->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-complete">{{ $todo->is_completed ? 'ត្រឡប់វិញ' : 'ធ្វើរួច' }}</button>
                    </form>
                    
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn-edit">កែប្រែ</a>
                    
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">លុប</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

</body>
</html>