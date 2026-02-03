<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;

class NotesCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_notes_index()
    {
        Note::factory()->count(3)->create();

        $this->get(route('notes.index'))
            ->assertStatus(200)
            ->assertSeeText('Notes');
    }

    /** @test */
    public function it_can_create_a_note()
    {
        $response = $this->post(route('notes.store'), [
            'title' => 'Test Note',
            'body' => 'This is a note body',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('notes', ['title' => 'Test Note']);
    }

    /** @test */
    public function it_can_update_a_note()
    {
        $note = Note::factory()->create(['title' => 'Old']);

        $this->put(route('notes.update', $note), [
            'title' => 'Updated',
            'body' => 'Updated body',
        ])->assertRedirect();

        $this->assertDatabaseHas('notes', ['id' => $note->id, 'title' => 'Updated']);
    }

    /** @test */
    public function it_can_delete_a_note()
    {
        $note = Note::factory()->create();

        $this->delete(route('notes.destroy', $note))->assertRedirect();

        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    /** @test */
    public function it_can_search_notes()
    {
        Note::factory()->create(['title' => 'Laravel Tips']);
        Note::factory()->create(['title' => 'Other stuff']);

        $this->get(route('notes.index', ['q' => 'Laravel']))
            ->assertStatus(200)
            ->assertSeeText('Laravel Tips')
            ->assertDontSeeText('Other stuff');
    }
}
