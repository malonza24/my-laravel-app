<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Child - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; min-height: 100vh; }
        .navbar {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h2 { color: white; font-size: 20px; }
        .navbar a { color: white; text-decoration: none; font-size: 14px; }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .card h2 { font-size: 22px; color: #333; margin-bottom: 24px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 600; }
        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 16px;
        }
        input:focus, select:focus { border-color: #f5576c; }
        .hidden { display: none; }
        button {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 8px;
        }
        button:hover { opacity: 0.9; }
        .error { color: #e53e3e; font-size: 12px; margin-top: -12px; margin-bottom: 12px; }
        .section-title { font-size: 16px; color: #f5576c; font-weight: 700; margin: 20px 0 12px; border-bottom: 2px solid #f5576c; padding-bottom: 6px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>👶 Register Child</h2>
        <a href="/parent/dashboard">← Back to Dashboard</a>
    </div>

    <div class="container">
        <div class="card">
            <h2>Child Registration Form</h2>

            <form action="/parent/child/register" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="section-title">Basic Information</div>

                <label>Child's Full Name</label>
                <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"/>
                @error('name') <div class="error">{{ $message }}</div> @enderror

                <label>Gender</label>
                <select name="gender">
                    <option value="">-- Select Gender --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender') <div class="error">{{ $message }}</div> @enderror

                <label>Age (years)</label>
                <input type="number" name="age" placeholder="3" min="1" max="12" value="{{ old('age') }}"/>
                @error('age') <div class="error">{{ $message }}</div> @enderror

                <label>Child's Photo</label>
                <input type="file" name="photo" accept="image/*"/>
                @error('photo') <div class="error">{{ $message }}</div> @enderror

                <div class="section-title">Health Information</div>

                <label>Does the child have a disability?</label>
                <select name="has_disability" id="disability_select" onchange="toggleField('disability_select', 'disability_details')">
                    <option value="0" {{ old('has_disability') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('has_disability') == '1' ? 'selected' : '' }}>Yes</option>
                </select>

                <div id="disability_details" class="{{ old('has_disability') == '1' ? '' : 'hidden' }}">
                    <label>Please describe the disability</label>
                    <input type="text" name="disability_details" placeholder="e.g. Visual impairment" value="{{ old('disability_details') }}"/>
                    @error('disability_details') <div class="error">{{ $message }}</div> @enderror
                </div>

                <label>Does the child have any allergies?</label>
                <select name="has_allergy" id="allergy_select" onchange="toggleField('allergy_select', 'allergy_details')">
                    <option value="0" {{ old('has_allergy') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('has_allergy') == '1' ? 'selected' : '' }}>Yes</option>
                </select>

                <div id="allergy_details" class="{{ old('has_allergy') == '1' ? '' : 'hidden' }}">
                    <label>Please describe the allergy</label>
                    <input type="text" name="allergy_details" placeholder="e.g. Peanuts, dairy" value="{{ old('allergy_details') }}"/>
                    @error('allergy_details') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="section-title">Schedule</div>

                <label>Check-in Time</label>
                <input type="time" name="checkin_time" value="{{ old('checkin_time') }}"/>
                @error('checkin_time') <div class="error">{{ $message }}</div> @enderror

                <label>Expected Check-out Time</label>
                <input type="time" name="checkout_time" value="{{ old('checkout_time') }}"/>
                @error('checkout_time') <div class="error">{{ $message }}</div> @enderror

                <button type="submit">Register Child & Proceed to Payment 💳</button>
            </form>
        </div>
    </div>

    <script>
        function toggleField(selectId, fieldId) {
            const select = document.getElementById(selectId);
            const field = document.getElementById(fieldId);
            field.classList.toggle('hidden', select.value === '0');
        }
    </script>
</body>
</html>