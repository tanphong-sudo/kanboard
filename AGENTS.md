<!-- gitnexus:start -->
# GitNexus — Code Intelligence

This project is indexed by GitNexus as **kanboard** (14268 symbols, 49222 relationships, 300 execution flows). Use the GitNexus MCP tools to understand code, assess impact, and navigate safely.

> If any GitNexus tool warns the index is stale, run `npx gitnexus analyze` in terminal first.

## Always Do

- **MUST run impact analysis before editing any symbol.** Before modifying a function, class, or method, run `gitnexus_impact({target: "symbolName", direction: "upstream"})` and report the blast radius (direct callers, affected processes, risk level) to the user.
- **MUST run `gitnexus_detect_changes()` before committing** to verify your changes only affect expected symbols and execution flows.
- **MUST warn the user** if impact analysis returns HIGH or CRITICAL risk before proceeding with edits.
- When exploring unfamiliar code, use `gitnexus_query({query: "concept"})` to find execution flows instead of grepping. It returns process-grouped results ranked by relevance.
- When you need full context on a specific symbol — callers, callees, which execution flows it participates in — use `gitnexus_context({name: "symbolName"})`.

## Never Do

- NEVER edit a function, class, or method without first running `gitnexus_impact` on it.
- NEVER ignore HIGH or CRITICAL risk warnings from impact analysis.
- NEVER rename symbols with find-and-replace — use `gitnexus_rename` which understands the call graph.
- NEVER commit changes without running `gitnexus_detect_changes()` to check affected scope.

## Resources

| Resource | Use for |
|----------|---------|
| `gitnexus://repo/kanboard/context` | Codebase overview, check index freshness |
| `gitnexus://repo/kanboard/clusters` | All functional areas |
| `gitnexus://repo/kanboard/processes` | All execution flows |
| `gitnexus://repo/kanboard/process/{name}` | Step-by-step execution trace |

## CLI

| Task | Read this skill file |
|------|---------------------|
| Understand architecture / "How does X work?" | `.claude/skills/gitnexus/gitnexus-exploring/SKILL.md` |
| Blast radius / "What breaks if I change X?" | `.claude/skills/gitnexus/gitnexus-impact-analysis/SKILL.md` |
| Trace bugs / "Why is X failing?" | `.claude/skills/gitnexus/gitnexus-debugging/SKILL.md` |
| Rename / extract / split / refactor | `.claude/skills/gitnexus/gitnexus-refactoring/SKILL.md` |
| Tools, resources, schema reference | `.claude/skills/gitnexus/gitnexus-guide/SKILL.md` |
| Index, status, clean, wiki CLI commands | `.claude/skills/gitnexus/gitnexus-cli/SKILL.md` |

<!-- gitnexus:end -->

## Project

Kanboard customization for a university project-management assignment.

This repo starts from upstream Kanboard. The goal is to make a working demo system for student-team task management, not to build a new app.

## Current state

Docker already runs successfully.

Continue from the user-requested step only. Do not jump ahead.

## Repo map

- `docker-compose.sqlite.yml`: local demo runtime.
- `Dockerfile`: Kanboard container build.
- `app/`: Kanboard core. Avoid editing unless explicitly approved.
- `plugins/`: preferred location for custom features.
- `assets/`: static CSS/JS/images. Use only for light UI changes.
- `data/`: runtime data. Do not commit real data/secrets.
- `tests/`: upstream tests.
- `Makefile`: available test/build helpers.

## Commands

Run from repo root.

```bash
docker compose -f docker-compose.sqlite.yml up -d
docker compose -f docker-compose.sqlite.yml ps
docker compose -f docker-compose.sqlite.yml logs --tail=100 app
docker compose -f docker-compose.sqlite.yml down
make test-sqlite
```

If `make test-sqlite` cannot run because dev dependencies are missing, report that clearly and validate with Docker/browser checks instead.

## Work order

1. Inspect files relevant to the current task.
2. Write/update `PLANS.md` with:
   - current step
   - files expected to change
   - exact implementation plan
   - validation checklist
3. Make the smallest safe change.
4. Validate.
5. Report changed files, validation result, and remaining risks.

Do not edit first and explain later.

## Scope by phase

### Step 2: Configure student-team usage

Prefer using the running Kanboard UI/admin features, not source edits.

Target configuration:

- Create one student project.
- Use columns:
  - `Chưa làm`
  - `Đang làm`
  - `Chờ phản hồi`
  - `Hoàn thành`
- Add six demo users:
  - `phong`
  - `phat`
  - `phuoc`
  - `tri`
  - `hoanganh`
  - `anhduc`
- Assign reasonable roles for a student team.
- Document task conventions in `ASSIGNMENT.md`.

Only create/update docs for this step unless the user explicitly asks for code changes.

### Later steps

- Step 3: project template and demo tasks.
- Step 4: light UI customization.
- Step 5: quick filters.
- Step 6: simple dashboard plugin.
- Step 7: testing evidence.

Do not implement later steps early.

## Kanboard customization rules

- Prefer plugins over core edits.
- Prefer configuration over code.
- Keep custom code isolated under `plugins/`.
- Do not modify `vendor/`, `.git/`, generated files, or runtime database files.
- Avoid touching `app/` unless there is no plugin/configuration path and the user approves.
- No broad redesign. Only small changes that can be explained in the report.

## Coding style

- Match existing Kanboard PHP style.
- Keep names explicit.
- Do not add comments unless they explain non-obvious integration behavior.
- Do not introduce new dependencies without approval.
- Keep changes easy to revert.

## Validation

For each task, perform the strongest practical validation:

- Docker container still starts.
- Relevant page works in browser.
- Logs show no fatal errors.
- Any changed PHP syntax is valid.
- For plugin work, plugin is visible/enabled and feature works.
- For documentation-only steps, verify Markdown files exist and match the requested scope.

Never claim browser/UI success unless actually checked.

## Security

- Do not commit real passwords, tokens, cookies, or private data.
- Demo credentials must be clearly fake/local-only.
- Do not expose `.env`, database dumps, or personal information beyond the project team names already provided.

## Report evidence

After each completed step, list screenshots the user should capture.

For Step 2, expected evidence:

- project list
- board with four columns
- users/member list
- one example task settings page
- short note mapping the setup to the report scope

## Stop and ask

Stop before proceeding if:

- the task requires editing `app/`
- the task requires a database migration
- Docker breaks
- credentials are missing
- the request conflicts with the project scope