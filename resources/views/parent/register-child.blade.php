<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Child - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #f43f5e; --primary-dark: #e11d48; --bg: #f1f5f9; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); min-height: 100vh; }
        .navbar { background: white; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow); position: sticky; top: 0; z-index: 100; }
        .navbar .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: linear-gradient(135deg, #f43f5e, #f97316); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand-text { font-size: 16px; font-weight: 800; color: var(--text); }
        .brand-text span { color: var(--primary); }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .back-btn { display: flex; align-items: center; gap: 6px; color: var(--text-light); text-decoration: none; font-size: 14px; padding: 8px 16px; border-radius: 8px; border: 1px solid var(--border); }
        .container { max-width: 700px; margin: 32px auto; padding: 0 20px; }
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 24px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .page-header p { color: var(--text-light); font-size: 14px; margin-top: 4px; }
        .card { background: white; border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow); margin-bottom: 24px; }
        .section-title { font-size: 14px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; padding-bottom: 12px; border-bottom: 2px solid #fff1f2; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); width: 18px; height: 18px; }
        input[type="text"], input[type="number"], input[type="time"], input[type="file"], select {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: border 0.2s;
            color: var(--text);
            background: white;
        }
        input[type="file"] { padding: 10px 14px 10px 44px; }
        input:focus, select:focus { border-color: var(--primary); }
        .hidden { display: none; }
        .error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        .btn { width: 100%; padding: 14px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn:hover { opacity: 0.9; }
        .toggle-group { background: var(--bg); border-radius: 10px; padding: 16px; }
        .toggle-label { font-size: 14px; color: var(--text); font-weight: 500; margin-bottom: 12px; }
        .toggle-options { display: flex; gap: 10px; }
        .toggle-options label { display: flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; border: 2px solid var(--border); cursor: pointer; font-weight: 500; font-size: 14px; margin-bottom: 0; }
        .toggle-options input[type="radio"] { width: auto; padding: 0; border: none; }
        .toggle-options label:has(input:checked) { border-color: var(--primary); background: #fff1f2; color: var(--primary); }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="/parent/dashboard" class="brand">
            <div class="brand-icon"><i data-lucide="heart" style="width:16px;height:16px;"></i></div>
            <span class="brand-text">Diligent <span>Mom</span></span>
        </a>
        <div class="nav-right">
            <a href="/parent/dashboard" class="back-btn">
                <i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1><i data-lucide="user-plus" style="width:24px;height:24px;color:#f43f5e;"></i> Register Child</h1>
            <p>Fill in your child's details to complete registration</p>
        </div>

        <form action="/parent/child/register" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Basic Info -->
            <div class="card">
                <div class="section-title">
                    <i data-lucide="info" style="width:16px;height:16px;"></i> Basic Information
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Child's Full Name</label>
                        <div class="input-wrap">
                            <i data-lucide="user" class="input-icon"></i>
                            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"/>
                        </div>
                        @error('name') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Age (years)</label>
                        <div class="input-wrap">
                            <i data-lucide="calendar" class="input-icon"></i>
                            <input type="number" name="age" placeholder="3" min="1" max="12" value="{{ old('age') }}"/>
                        </div>
                        @error('age') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="input-wrap">
                            <i data-lucide="users" class="input-icon"></i>
                            <select name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        @error('gender') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Child's Photo</label>
                        <div class="input-wrap">
                            <i data-lucide="image" class="input-icon"></i>
                            <input type="file" name="photo" accept="image/*"/>
                        </div>
                        @error('photo') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Health Info -->
            <div class="card">
                <div class="section-title">
                    <i data-lucide="heart-pulse" style="width:16px;height:16px;"></i> Health Information
                </div>
                <div class="form-group">
                    <label>Does the child have a disability?</label>
                    <div class="input-wrap">
                        <i data-lucide="accessibility" class="input-icon"></i>
                        <select name="has_disability" id="disability_select" onchange="toggleField('disability_select', 'disability_details')">
                            <option value="0" {{ old('has_disability') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('has_disability') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
                <div id="disability_details" class="{{ old('has_disability') == '1' ? '' : 'hidden' }} form-group">
                    <label>Describe the disability</label>
                    <div class="input-wrap">
                        <i data-lucide="file-text" class="input-icon"></i>
                        <input type="text" name="disability_details" placeholder="e.g. Visual impairment" value="{{ old('disability_details') }}"/>
                    </div>
                    @error('disability_details') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Does the child have any allergies?</label>
                    <div class="input-wrap">
                        <i data-lucide="alert-triangle" class="input-icon"></i>
                        <select name="has_allergy" id="allergy_select" onchange="toggleField('allergy_select', 'allergy_details')">
                            <option value="0" {{ old('has_allergy') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('has_allergy') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
                <div id="allergy_details" class="{{ old('has_allergy') == '1' ? '' : 'hidden' }} form-group">
                    <label>Describe the allergy</label>
                    <div class="input-wrap">
                        <i data-lucide="file-text" class="input-icon"></i>
                        <input type="text" name="allergy_details" placeholder="e.g. Peanuts, dairy" value="{{ old('allergy_details') }}"/>
                    </div>
                    @error('allergy_details') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Schedule -->
            <div class="card">
                <div class="section-title">
                    <i data-lucide="clock" style="width:16px;height:16px;"></i> Schedule
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Check-in Time</label>
                        <div class="input-wrap">
                            <i data-lucide="log-in" class="input-icon"></i>
                            <input type="time" name="checkin_time" value="{{ old('checkin_time') }}"/>
                        </div>
                        @error('checkin_time') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Expected Check-out Time</label>
                        <div class="input-wrap">
                            <i data-lucide="log-out" class="input-icon"></i>
                            <input type="time" name="checkout_time" value="{{ old('checkout_time') }}"/>
                        </div>
                        @error('checkout_time') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn">
                    <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
                    Register Child & Proceed to Payment
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleField(selectId, fieldId) {
            const select = document.getElementById(selectId);
            const field = document.getElementById(fieldId);
            field.classList.toggle('hidden', select.value === '0');
        }
        lucide.createIcons();
    </script>
</body>
</html>