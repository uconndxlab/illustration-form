<!DOCTYPE html>
<html>
    <head>
        <title>Illustration Request</title>
    </head>
    <body>
        <h1>Illustration request form:</h1>
        @if(session('success'))
            <div class="alert alert-success">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <br>
        <form action="{{ route('illform.submit') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label>Is this a journal cover illustration request?</label><br>
            <input type="radio" id="yes_jc" name="journal_cover" value="yes_free" {{ old('journal_cover') == "yes_free" ? 'checked' : '' }} required>
            <label for="yes_jc">Yes *Free Service</label><br>
            <input type="radio" id="no_jc" name="journal_cover" value="no_paid" {{ old('journal_cover') == "no_paid" ? 'checked' : '' }} required>
            <label for="no_jc">No *Paid Service</label><br><br>

            <label for="ill_desc">Provide a brief description of what you would like illustrated:</label><br>
            <textarea id="ill_desc" name="description" rows="3" cols="50" required>{{ old('description') }}</textarea><br>
            <br>

            <label>Is there a hard deadline?</label><br>
            <input type="radio" id="yes_deadline" name="deadline" value="1" {{ old('deadline') == "1" ? 'checked' : '' }} required>
            <label for="yes_jc">Yes</label>
            <input type="date" id="date_deadline" name="date" value="{{ old('date') }}"><br>
            <input type="radio" id="no_deadline" name="deadline" value="0" {{ old('deadline') == "0" ? 'checked' : '' }} required>
            <label for="no_deadline">No</label><br>
            <br>

            <label><strong>If available, please attach the following:</strong></label><br>
            <label for="article_draft">A copy of the article/draft for the illustrators to reference</label><br>
            <input type="file" id="article_draft" name="article_draft_ref" value="{{ old('article_draft_ref') }}"><br>
            <label for="photos">Any reference photos for content or style</label><br>
            <input type="file" id="photos" name="photos_ref[]" value="{{ old('photos_ref[]') }}" multiple><br>
            <label for="add_illustrations">Any additional illustrations that will be included with the anticipated illustration</label><br>
            <input type="file" id="add_illustrations" name="add_ill_ref[]" value="{{ old('add_ill_ref[]') }}" multiple><br>
            <label for="init_illustration">The initial illustration (in the case of a remake of an existing illustration)</label><br>
            <input type="file" id="init_illustration" name="init_ill_ref" value="{{ old('init_ill_ref') }}"><br>
            <br>

            <label for="journal_name">If relevant, please provide the name of the journal where the work will be submitted (for the illustrators to work within journal standards).</label><br>
            <input type="text" id="journal_name" name="journal_name" value="{{ old('journal_name') }}"></textarea><br>
            <br>

            <label><strong>Primary contact information:</strong></label><br>
            <label for="name">Full Name:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="{{ old('email') }}" required><br>
            <label for="phone">Phone</label><br>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required><br>
            <br>

            <div id="hidden_kfs" style="display: none">
                <label for="kfs_account">Expected KFS account number (note, there will be no billing until a preliminary quote is provided):</label><br>
                <input type="text" id="kfs_account" name="kfs_account" value="{{ old('kfs_account') }}"><br>
                <br>
            </div>
            
            @if ($errors->any())
                <ul>
                    <li>{{ $errors->first() }}</li>
                </ul>
            @endif

            <input type="submit" value="Submit">
    </form>
    <script>
        const yes_deadline = document.getElementById("yes_deadline")
        const no_deadline = document.getElementById("no_deadline")
        const date_deadline = document.getElementById("date_deadline")
        const yes_jc = document.getElementById("yes_jc")
        const no_jc = document.getElementById("no_jc")
        const kfs_div = document.getElementById("hidden_kfs")
        const kfs_q = document.getElementById("kfs_account")

        function toggleDeadlineReq() {
            date_deadline.required = yes_deadline.checked
        }
        yes_deadline.addEventListener("change", toggleDeadlineReq)
        no_deadline.addEventListener("change", toggleDeadlineReq)

        function showKFS() {
            kfs_q.required = no_jc.checked
            if (no_jc.checked) {
                kfs_div.style.display = 'block'
            }
            else {
                kfs_div.style.display = 'none'
                kfs_q.value = ''                    //reset KFS
            }
        }
        yes_jc.addEventListener("change", showKFS)
        no_jc.addEventListener("change", showKFS)

        //determine if showing kfs on load - if using old data
        window.onload = function() {
            showKFS();
        }
    </script>
    </body>
</html>

