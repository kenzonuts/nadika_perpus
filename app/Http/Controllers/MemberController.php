<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Services\MemberService;
use App\ViewModels\MemberFormViewModel;
use App\ViewModels\MemberIndexViewModel;
use App\ViewModels\MemberShowViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(MemberService $service): View
    {
        $members = $service->paginate()->getCollection()->load('user');

        return view('members.index', array_merge(['members' => (new MemberIndexViewModel($members))->toArray()], (new MemberFormViewModel())->toArray()));
    }

    public function create(): View
    {
        return view('members.create', (new MemberFormViewModel())->toArray());
    }

    public function store(StoreMemberRequest $request, MemberService $service): RedirectResponse
    {
        $service->create($request->validated());
        return redirect()->route('members.index');
    }

    public function show(Member $member): View
    {
        $member->load(['user', 'borrowings.items.book']);

        return view('members.show', [
            'members' => (new MemberShowViewModel($member))->toArray(),
            'borrowHistory' => $member->borrowings->flatMap(fn ($borrowing) => $borrowing->items->map(fn ($item): array => [
                'book' => $item->book?->title ?? '-',
                'action' => $item->status->value === 'returned' ? 'Returned' : 'Borrowed',
                'date' => $item->created_at?->diffForHumans() ?? '-',
                'due_date' => $borrowing->due_date?->format('d M Y'),
                'color' => $item->status->value === 'returned' ? 'success' : 'warning',
            ]))->all(),
        ]);
    }

    public function edit(Member $member): View
    {
        $member->load('user');

        return view('members.edit', (new MemberFormViewModel($member))->toArray());
    }

    public function update(UpdateMemberRequest $request, Member $member, MemberService $service): RedirectResponse
    {
        $service->update($member->id, $request->validated());
        return redirect()->route('members.show', $member);
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();
        return redirect()->route('members.index');
    }

    public function trash(MemberService $service): View
    {
        $trashed = $service->trash()->getCollection()->load('user');

        return view('members.trash', ['trashedMembers' => (new MemberIndexViewModel($trashed))->toArray()]);
    }
}
