
    <div class="form-group">
        <label for="">F.I.O</label>
        <input type="text" class="form-control" name="name" required value="{{ $teacher->name ?? '' }}">
    </div>
    <div class="form-group">
        <label for="">Lavozimi</label>
        <input type="text" class="form-control" name="profession" value="{{ $teacher->profession ?? '' }}">
    </div>
    <div class="form-group">
        <label for="">Telefon</label>
        <input type="text" class="form-control" name="phone" value="{{ $teacher->phone ?? '' }}" required>
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" required value="{{ $teacher->email ?? '' }}">
    </div>
    <div class="form-group">
        <label for="">Tug'ilgan yili</label>
        <input type="date" class="form-control" name="birthday" value="{{ $teacher->birthday ?? '' }}">
    </div>
   
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Yangilash">
    </div>
