<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>កែប្រែការងារ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&display=swap');
        body { 
        font-family: 'Battambang', Arial, sans-serif; 
        max-width: 600px; 
        margin: 50px auto; }
        .input-group { display: flex; gap: 10px; }
        input[type="text"] { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 3px; }
        button { background: #28a745; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 3px; }
        .back-btn { background: #6c757d; text-decoration: none; padding: 8px 12px; color: white; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>កែប្រែការងារ</h2>

    <form action="{{ route('todo.update', $todo->id) }}" method="POST" class="input-group">
        @csrf
        @method('PUT')
        
        <select name="category_id" required style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $todo->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="title" value="{{ $todo->title }}" required>
        <button type="submit">រក្សាទុក</button>
        <a href="/todos" class="back-btn">ត្រឡប់ក្រោយ</a>
    </form>
</body>
</html>