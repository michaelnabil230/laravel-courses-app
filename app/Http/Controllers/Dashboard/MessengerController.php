<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QaTopicCreateRequest;
use App\Http\Requests\Dashboard\QaTopicReplyRequest;
use App\Models\Admin;
use App\Models\QaTopic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessengerController extends Controller
{
    public function index(Request $request): View
    {
        $topics = QaTopic::query()
            ->where(function ($query) {
                $query
                    ->where('creator_id', auth('admin')->id())
                    ->orWhere('receiver_id', auth('admin')->id());
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        $title = __('dashbord.all_messages');
        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.index', compact('topics', 'title', 'unreads'));
    }

    public function unreadTopics(): array
    {
        $topics = QaTopic::query()
            ->where(function ($query) {
                $query
                    ->where('creator_id', auth('admin')->id())
                    ->orWhere('receiver_id', auth('admin')->id());
            })
            ->with('messages')
            ->latest()
            ->get();

        $inboxUnreadCount = 0;
        $outboxUnreadCount = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if (
                    $message->sender_id !== auth('admin')->id()
                    && $message->read_at === null
                ) {
                    if ($topic->creator_id !== auth('admin')->id()) {
                        $inboxUnreadCount++;
                    } else {
                        $outboxUnreadCount++;
                    }
                }
            }
        }

        return [
            'inbox' => $inboxUnreadCount,
            'outbox' => $outboxUnreadCount,
        ];
    }

    public function createTopic(): View
    {
        $admins = Admin::where('id', '!=', auth('admin')->id())->get();
        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.create', compact('admins', 'unreads'));
    }

    public function storeTopic(QaTopicCreateRequest $request): RedirectResponse
    {
        $topic = QaTopic::create([
            'subject' => $request->subject,
            'creator_id' => auth('admin')->id(),
            'receiver_id' => $request->recipient,
        ]);

        $topic->messages()->create([
            'sender_id' => auth('admin')->id(),
            'content' => $request->content,
        ]);

        return to_route('dashbord.messenger.index');
    }

    public function showMessages(QaTopic $topic): View
    {
        $this->checkAccessRights($topic);

        foreach ($topic->messages as $message) {
            if ($message->sender_id !== auth('admin')->id() && $message->read_at === null) {
                $message->read_at = now();
                $message->save();
            }
        }

        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.show', compact('topic', 'unreads'));
    }

    private function checkAccessRights(QaTopic $topic)
    {
        $user = auth('admin')->user();

        abort_if(! in_array($user->id, [$topic->creator_id, $topic->receiver_id]), 401);
    }

    public function destroyTopic(QaTopic $topic): RedirectResponse
    {
        $this->checkAccessRights($topic);

        $topic->delete();

        return to_route('dashbord.messenger.index');
    }

    public function showInbox(): View
    {
        $title = __('dashbord.inbox');

        $topics = QaTopic::query()
            ->where('receiver_id', auth('admin')->id())
            ->latest()
            ->paginate()
            ->appends(request()->query());

        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.index', compact('topics', 'title', 'unreads'));
    }

    public function showOutbox(): View
    {
        $title = __('dashbord.outbox');

        $topics = QaTopic::query()
            ->where('creator_id', auth('admin')->id())
            ->latest()
            ->paginate()
            ->appends(request()->query());

        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.index', compact('topics', 'title', 'unreads'));
    }

    public function replyToTopic(QaTopicReplyRequest $request, QaTopic $topic): RedirectResponse
    {
        $this->checkAccessRights($topic);

        $topic->messages()->create([
            'sender_id' => auth('admin')->id(),
            'content' => $request->input('content'),
        ]);

        return to_route('dashbord.messenger.index');
    }

    public function showReply(QaTopic $topic): View
    {
        $this->checkAccessRights($topic);

        $receiverOrCreator = $topic->receiverOrCreator();

        abort_if($receiverOrCreator === null || $receiverOrCreator->trashed(), 404);

        $unreads = $this->unreadTopics();

        return view('dashbord.messenger.reply', compact('topic', 'unreads'));
    }
}
