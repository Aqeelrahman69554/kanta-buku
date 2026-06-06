@forelse($publishers as $index => $pub)
    <tr>
        <td>{{ $publishers->firstItem() + $index }}</td>
        <td>{{ $pub->name }}</td>
        <td>{{ $pub->city ?? '-' }}</td>
        <td class="text-center">
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $pub->id }}">
                Edit
            </button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $pub->id }}">
                Hapus
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center text-muted py-3">Belum ada data penerbit.</td>
    </tr>
@endforelse

<tr class="d-none"><td id="ajax-pagination-data">{{ $publishers->links() }}</td></tr>
